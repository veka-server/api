<?php

namespace App\classe;

use VekaServer\BddSqlite\Bdd;

class BddDemo extends Bdd
{

    public function __construct($param) {
        parent::__construct($param);

        /** init la BDD sqlite de demo a chaque connexion a la bdd */
        $this->initDemo();
    }

    public function initDemo(){
        $this->beginTransaction();

        $sql = /** @lang SQL */ 'DROP TABLE IF EXISTS utilisateurs ;';
        $this->exec($sql);

        $sql = /** @lang SQL */ 'CREATE TABLE IF NOT EXISTS utilisateurs (
                    id_utilisateur integer  PRIMARY KEY AUTOINCREMENT,
                    nom character varying(64) NOT NULL,
                    prenom character varying(64) NOT NULL,
                    telephone character varying(30),
                    email character varying(128) NOT NULL UNIQUE,
                    password character varying(60) NOT NULL,
                    date_creation datetime DEFAULT current_timestamp NOT NULL,
                    disable boolean DEFAULT false NOT NULL,
                    lang character varying(8) DEFAULT \'fr\',
                    timezone character varying(255) DEFAULT \'Europe/Paris\'
                );';
        $this->exec($sql);

        $pass = \App\classe\Utilisateur::hash('0000');
        for ($i=0;$i<=150; $i++){
            $sql = 'INSERT INTO utilisateurs (nom, prenom, email, password) VALUES ( \'dupond\', \'nicolas '.$i.'\', \'test'.$i.'@test.fr\', \''.$pass.'\') ;';
            $this->exec($sql);
        }

        $this->commit();
    }

}