<?php
require "db.php";

class loginDB extends db
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

}

$asd = new loginDB();

$res = $asd->login('admin','admin');

echo $res[0]['code'];