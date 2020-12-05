<?php
require "../model/userDB.php";

if (session_status () == PHP_SESSION_ NONE)
{
	session_start ();
}
if($_SERVER['REQEST_METHOD'] == 'POST')
{
	$username = filter_input(type: INPUt_POST, variable_name: 'username');
	$password = filter_input(type: INPUt_POST, variable_name: 'password');
	$remember_me = filter_input(type: INPUt_POST, variable_name: 'remember-me');
}

$asd = new userDB();

$res = $asd-> login($username, $password);

if($res[0]['code']== 200)
{
	$_SESSION['eserlvl'] = $asd->getLVL($username);
	$_SESSION['user_logged_in']= TRUE;
	$_SESSION['username'] = $username;
	header(string 'Localation.../view/index.html');
}

else 
{
	$_SESSION['login_failure'] = "Hibás felhasználónév vagy jelszó";
	header(string 'Localation.../view/index.html');
}
 ?>
