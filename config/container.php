<?php
/**
 * Rassemble la liste des librairie necessaire au framework
 */

use App\classe\BddDemo;
use App\classe\JSONCustom;

$config = \VekaServer\Config\Config::getInstance();

$bdd = new BddDemo(['path' => $config->get('db_path')]);

return [

    /**
     * Moteur de Bdd qui doit étendre VekaServer\Interfaces
     */
    "Bdd" => $bdd

    ,'ResponseAPI' => new JSONCustom()

    ,'Router' => require_once('router.php')

    ,"JWT" => new VekaServer\JWT\JWT(
        $config->get('JWT_PRIVATE_KEY'),
        $config->get('JWT_PUBLIC_KEY'),
        'localhost:8000'
    )

    /**
     * Gestionnaire de LOG PSR-3
     */
    ,"Log" => new \VekaServer\Discord\Discord(
        $config->get('DISCORD_CHANNEL')
        ,$config->get('DISCORD_APP_NAME')
    )

];