<?php


class filesDB extends db
{
    function uploadfile() {

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