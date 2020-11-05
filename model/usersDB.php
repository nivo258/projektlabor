<?php
require "db.php";

class usersDB extends db
{

    function login($username,$pw) {

        $result = $this->select("SELECT * FROM `users` WHERE Username like '".$username."' AND Password like '". $pw."';");

        if (count($result)==0) {
            $result[0]['code']=404;
            $this->select("INSERT INTO `log`(`Date`, `Log`) VALUES ('".date('Y-m-d h:i:sa')."','Sikertelen bejelentkezés (".$username.")');");
        }
        else {
            $result[0]['code']=200;
            $this->select("INSERT INTO `log`(`Date`, `Log`) VALUES ('".date('Y-m-d h:i:sa')."','Sikeres bejelentkezés (".$username.")');");
        }



        return $result;
    }

    function listall() {
        $result = $this->select("SELECT * FROM `users` ;");

        return $result;
    }

    function register($username,$pw,$userlvl=0) {

        $check = $this->select("SELECT * FROM `users` WHERE Username like '".$username."';");

        if (count($check)==0) {
            $this->select("INSERT INTO `users`(`Username`, `Password`, `Userlvl`) VALUES ('" . $username . "' , '" . $pw . "' , '" . $userlvl . "');");
            $this->select("INSERT INTO `log`(`Date`, `Log`) VALUES ('".date('Y-m-d h:i:sa')."','Sikeres felhasználó regisztrálás (".$username.")');");
            $result = 1;
        }
        else {
            $this->select("INSERT INTO `log`(`Date`, `Log`) VALUES ('".date('Y-m-d h:i:sa')."','Sikertelen felhasználó regisztrálás (".$username.")');");
            $result = 0;
        }
        return $result;

    }
    function delete_user($id) {
        $this->select("DELETE FROM `users` WHERE `ID` = ".$id.";");
        $this->select("INSERT INTO `log`(`Date`, `Log`) VALUES ('".date('Y-m-d h:i:sa')."','Felhasználó törlésre került (ID: ".$id.")');");
    }
    function edit_user($id,$username=null,$pw=null,$userlvl=null) {

        $this->select("INSERT INTO `log`(`Date`, `Log`) VALUES ('".date('Y-m-d h:i:sa')."','Felhasználó modosításra került (".$id." | ".$username." | ".$pw." | ".$userlvl.")');");

        $code = "UPDATE `users` SET";

        if ($username != null and ($pw != null or $userlvl != null)) {
            $code = $code."`Username`='".$username."',";

            if ($pw != null and $userlvl != null) {
                $code = $code."`Password`='".$pw."',";
            }
            elseif ($pw != null) {
                $code = $code."`Password`='".$pw."'";
            }
            if ($userlvl != null){
                $code = $code."`Userlvl`=".$userlvl;
            }
        }
        elseif ($username != null) {
            $code = $code."`Username`='".$username."'";
        }
        if ($pw != null and $userlvl != null) {
            $code = $code."`Password`='".$pw."',";
            $code = $code."`Userlvl`=".$userlvl;
        }
        elseif ($pw != null) {
            $code = $code."`Password`='".$pw."'";
        }
        else {
            $code = $code."`Userlvl`=".$userlvl;
        }

        $code = $code." WHERE ID=".$id.";";
        $this->select($code);

    }

}

$asd = new usersDB();

$asd->register('BWY8HW','Almafa12',1);

$asd->edit_user(2,null,null,2);


$res = $asd->login('BWY8HW','Almafa12');

echo $res[0]['code'];