<?php
require "db.php";

class createDB extends db
{
    function create () {

        $asd = 0;

        $this->select("CREATE TABLE IF NOT EXISTS Users (
    	ID int AUTO_INCREMENT PRIMARY KEY,
    	Username varchar(8),
    	Password varchar(32),
    	Admin bit
)");
        $asd = count($this->select("SELECT Username  FROM `users` WHERE Username='admin';"));

        if ($asd == 0) {
            $this->select("INSERT INTO `users`( `Username`, `Password`, `Admin`) VALUES ('admin','admin',1);");
        }
    }

}

$asd = new createDB;

$asd->create();

$sql = new db;
$array = $sql->select("SELECT * FROM users");

echo $array[0]['ID']." | ".$array[0]['Username'];