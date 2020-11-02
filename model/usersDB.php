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
    function delete_user($id) {
        $this->select("DELETE FROM `users` WHERE `ID` = ".$id.";");
    }
    function edit_user($id,$username=null,$pw=null,$userlvl=null) {

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