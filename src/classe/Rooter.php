<?php

namespace App\classe;

use VekaServer\Container\Container;
use VekaServer\JWT\JWT;

class Rooter extends \VekaServer\Rooter\Rooter
{

    protected function call($callable, array $params = [], $options = [])
    {
        // si page 404 on la charge immediatement
        if(is_array($callable) && $callable[1] == self::DEFAULT_404){
            return parent::call($callable, $params);
        }

        // si la route en cours requière un token JWT
        if( (bool)($options['token_jwt_required'] ?? true) === true){

            // recuperation des données issue de l'authentification JWT
            $jwtAttr = $this->request->getAttribute(JWT::ATTRIBUTE);
            if(($jwtAttr['success'] ?? false) === false){

                $responseApi = Container::getInstance()->get('ResponseAPI');
                $responseApi->error(401, $jwtAttr['error']['message'], $jwtAttr['error']['help']);

                $responseBuilder = new ResponseAPIBuilder();
                $responseBuilder->setApiFormat($responseApi);
                return  $responseBuilder->getResponse($this->handler, $this->request);
            }

        }

        return parent::call($callable, $params);
    }

}