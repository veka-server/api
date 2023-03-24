<?php
/**
 * Ce fichier doit obligatoirement retourner un un tableau avec en premier parametre un dispatcher et en second la request
 */

use VekaServer\Config\Config;
use VekaServer\Container\Container;

/**
 * Creation de la request (ServerRequestFactory) a partir de Nyholm
 */
$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();
$creator = new \Nyholm\Psr7Server\ServerRequestCreator($psr17Factory,$psr17Factory,$psr17Factory,$psr17Factory);

$config = Config::getInstance();
$tableau_middleware = [];

/** Redirection Erreur 500 */
$tableau_middleware[] = new VekaServer\RedirectErrorPage\RedirectErrorPage('/500');

/** Whoops */
if($config->get('ENV') == 'DEV') {
    $middleware_whoops = new Middlewares\Whoops();
    $tableau_middleware[] = $middleware_whoops;
}

/** Discord PSR-15 */
$tableau_middleware[] = Container::getInstance()->get('Log');

/** add JWT */
$tableau_middleware[] = Container::getInstance()->get('JWT');

/** router */
$tableau_middleware[] = Container::getInstance()->get('Router');

$dispatcher = new Middlewares\Utils\Dispatcher($tableau_middleware);
$request = $creator->fromGlobals();

return [$dispatcher,$request];