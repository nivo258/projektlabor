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

        $this->select("CREATE TABLE IF NOT EXISTS Log (
            ID int AUTO_INCREMENT PRIMARY KEY,
    	    Date DATETIME,
    	    Log VARCHAR(65535)
        )");





        $asd = count($this->select("SELECT Username  FROM `users` WHERE Username='admin';"));

        if ($asd == 0) {
            $this->select("INSERT INTO `users`( `Username`, `Password`, `Userlvl`) VALUES ('admin','admin',2);");
        }


    }

}

$asd = new createDB;

$return = $asd->create();

echo $return;




echo 'Adattáblák és admin felhasználó létrehozva vagy már léteznek!';