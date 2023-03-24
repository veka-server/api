<?php
/**
 * A utiliser avec le classe de rooter de veka-server/rooter
 * Ce fichier doit obligatoirement retourner un middleware
 */

$config = \VekaServer\Config\Config::getInstance();

return (new \App\classe\Rooter())

    // Pages de login retournant le token JWT
    ->get('/signup',function(){return (new \App\controller\Login())->signup();}, ['token_jwt_required' => false, 'no-regex' => true])

    // route de demo
    ->get('/utilisateurs',function(){return (new \App\controller\Utilisateur())->getAll();})
    ->get('/utilisateurs/([0-9]+)',function($id){return (new \App\controller\Utilisateur())->getByID($id);})
    ->post('/utilisateurs',function(){return (new \App\controller\Utilisateur())->add();})
    ->delete('/utilisateurs/([0-9]+)',function($id){return (new \App\controller\Utilisateur())->deleteByID($id);})
    ->patch('/utilisateurs/([0-9]+)',function($id){return (new \App\controller\Utilisateur())->updateByID($id);})
    ->put('/utilisateurs/([0-9]+)',function($id){return (new \App\controller\Utilisateur())->updateAllColumnByID($id);})

;