<?php
require "db.php";

class createDB extends db
{
    function create () {


        $this->select("CREATE TABLE IF NOT EXISTS Users (
    	ID int AUTO_INCREMENT PRIMARY KEY,
    	Username varchar(8),
    	Password varchar(32),
    	Userlvl int
        )");
        $asd = count($this->select("SELECT Username  FROM `users` WHERE Username='admin';"));

        if ($asd == 0) {
            $this->select("INSERT INTO `users`( `Username`, `Password`, `Userlvl`) VALUES ('admin','admin',2);");
        }
    }

}

$asd = new createDB;

$asd->create();


echo 'Adattáblák és admin felhasználó létrehozva vagy már léteznek!';