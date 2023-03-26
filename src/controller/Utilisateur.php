<?php
namespace App\controller;

use Psr\Http\Message\ResponseInterface;

class Utilisateur extends Controller
{
    /**
     * @OA\Get(
     *     path="/utilisateurs/[id]",
     *     @OA\Response(response="200", description="...")
     * )
     */
    public function getByID($id) :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

       $user = \App\model\Utilisateur::getByID($id);
       $this->responseApi->setHTTPCode(200 /* OK */);
       $this->responseApi->setData($user);
       return $this->send();
    }

    /**
     * @OA\Get(
     *     path="/utilisateurs",
     *     @OA\Response(response="200", description="...")
     * )
     */
    public function getAll() :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

       $users = \App\model\Utilisateur::getAll();
       $this->responseApi->setHTTPCode(200 /* OK */);
       $this->responseApi->setData($users);
       return $this->send();
    }

    /**
     * @OA\Post(
     *     path="/utilisateurs/[id]",
     *     @OA\Response(response="201", description="creer un utilisateur")
     * )
     */
    public function add() :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

        $this->responseApi->setHTTPCode(201 /* Created */);
        return $this->send();
    }

    /**
     * @OA\Delete(
     *     path="/utilisateurs/[id]",
     *     @OA\Response(response="204", description="")
     * )
     */
    public function deleteByID($id) :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

        $this->responseApi->setHTTPCode(204 /* No content */);
        return $this->send();
    }


    /**
     * @OA\Patch(
     *     path="/utilisateurs/[id]",
     *     @OA\Response(response="204", description="")
     * )
     */
    public function updateByID($id) :ResponseInterface
    {

        /** @todo verifier si l'utilisateur est toujours valide (droit/bans/...) */

        /** PATCH : Seul les colonnes recus seront mise a jour */

        $this->responseApi->setHTTPCode(204 /* No content */);
        return $this->send();
    }

    /**
     * @OA\Put(
     *     path="/utilisateurs/[id]",
     *     @OA\Response(response="204", description="")
     * )
     */
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