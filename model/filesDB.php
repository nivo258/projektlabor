<?php
require "db.php";


class filesDB extends db
{
    function uploadfile($filename, $link, $ownerID, $categoryID, $public) {
        $this->select("INSERT INTO `files`(`Filename`, `Link`, `OwnerID`, `CategoryID`, `Public`) VALUES ('".$filename."','".$link."',".$ownerID.",".$categoryID.",".$public.");");
        $this->log($filename." fájl feltöltésre került ".$ownerID."-es ID felhasználó által a ".$categoryID."-es kategóriába ( ".$link." )");

    }
    function deletefile() {

    }
    function editfile() {

    }
    function listallfiles() {
        $result = $this->select("SELECT * FROM `files`;");
        return $result;
    }
    function listfiles($categoryID) {
        $result = $this->select("SELECT * FROM `files` WHERE `CategoryID` = ".$categoryID.";");
        return $result;
    }
}


$asd = new filesDB();

$asd->uploadfile("Teszt","teszt.hu/asd/",1,1,1);