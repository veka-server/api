<?php
namespace App\controller;

use Psr\Http\Message\ResponseInterface;

class Utilisateur extends Controller
{

    public function getByID($id) :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

       $user = \App\model\Utilisateur::getByID($id);
       $this->responseApi->setHTTPCode(200 /* OK */);
       $this->responseApi->setData($user);
       return $this->send();
    }

    public function getAll() :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

       $users = \App\model\Utilisateur::getAll();
       $this->responseApi->setHTTPCode(200 /* OK */);
       $this->responseApi->setData($users);
       return $this->send();
    }

    public function add() :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

        $this->responseApi->setHTTPCode(201 /* Created */);
        return $this->send();
    }

    public function deleteByID($id) :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

        $this->responseApi->setHTTPCode(204 /* No content */);
        return $this->send();
    }

    public function updateByID($id) :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

        /** PATCH : Seul les colonnes recus seront mise a jour */

        $this->responseApi->setHTTPCode(204 /* No content */);
        return $this->send();
    }

    public function updateAllColumnByID($id)
    {
        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

        /** PUT : Cette methode doit modifier toute les colonnes modififables
         *  Si une colonne est manquante il est considéré que sa vaeur est null
         */

        $this->responseApi->setHTTPCode(204 /* No content */);
        return $this->send();
    }

}