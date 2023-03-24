<?php
namespace App\controller;

use App\model\Utilisateur;
use VekaServer\Container\Container;
use VekaServer\JWT\JWT;

class Login extends Controller
{

    public function signup(){

        /** verifier que l'utilisateur */
        $user = Utilisateur::getByEmail($_REQUEST['email'] ?? '');
        if( empty($user) || \App\classe\Utilisateur::verifyHash($_REQUEST['password'] ?? '', $user[0]['password']) === false){
            $this->responseApi->error(401, 'Bad credentials');
            return $this->send();
        }

        /** preparer les variables qui seront stocker dans le token (attention elles seront en clair) */
        $data = [
            'id_utilisateur' => $user[0]['id_utilisateur']
        ];

        /** Creer le token a retourner a l'utilisateur */
        /** @var JWT $jwt */
        $jwt = Container::getInstance()->get('JWT');
        $jwtToken = $jwt->getToken($data);

        $decoded = $jwt->decode($jwtToken);

        $retour = [
            "jwt" => $jwtToken,
            "expireAt" => $decoded->exp,
        ];

        $this->responseApi->setHTTPCode(200);
        $this->responseApi->setData($retour);
        return $this->send();
    }

    public function test(){

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

       $users = Utilisateur::getAll();

       $this->responseApi->setHTTPCode(200);
       $this->responseApi->setData($users);
       return $this->send();
    }

}