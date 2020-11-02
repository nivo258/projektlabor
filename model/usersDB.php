<?php
require "db.php";

class usersDB extends db
{

    function login($username,$pw) {

        $result = $this->select("SELECT * FROM `users` WHERE Username like '".$username."' AND Password like '". $pw."';");

        if (count($result)==0) {
            $result[0]['code']=404;
        }
        else {
            $result[0]['code']=200;
        }



        return $result;
    }

    function register($username,$pw,$userlvl=0) {

        $check = $this->select("SELECT * FROM `users` WHERE Username like '".$username."';");

        if (count($check)==0) {
            $this->select("INSERT INTO `users`(`Username`, `Password`, `Userlvl`) VALUES ('" . $username . "' , '" . $pw . "' , '" . $userlvl . "');");
            $result = 1;
        }
        else {
            $result = 0;
        }
        return $result;

    }

}

$asd = new usersDB();

$asd->register('Teszt4','Teszt',1);

$res = $asd->login('admin','admin');

echo $res[0]['code'];