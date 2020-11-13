<?php
require "db.php";


class categorysDB extends db
{
    function createcategory($catName,$description) {
        $this->select("INSERT INTO `categorys`(`CatName`, `Description`) VALUES ('".$catName."','".$description."');");
        $this->log($catName." kategória létrehozva");
    }
    function deletecategory($ID) {
        if ($ID == 1)
            echo "Default kategória nem törölhető";
        else
            $this->select("UPDATE `files` SET `CategoryID`=1 WHERE `CategoryID`=".$ID.";");
            $this->select("DELETE FROM `categorys` WHERE `categorys`.`ID` = ".$ID.";");
            $this->log($ID."-es kategória törölve");
    }
    function editcategory($ID,$catName=null,$description=null) {

    }

}
