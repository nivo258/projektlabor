<?php
require "../model/usersDB.php";

if (session_status () == PHP_SESSION_NONE)
{
	session_start ();
}
if($_SERVER['REQEST_METHOD'] == 'POST')
{
	$username = filter_input(INPUt_POST, 'username');
	$password = filter_input( INPUt_POST,  'password');
	$remember_me = filter_input( INPUt_POST,  'remember-me');
}

$asd = new userDB();

$res = $asd-> login($username, $password);

if($res[0]['code']== 200)
{
	$_SESSION['userlvl'] = $asd->getLVL($username);
	$_SESSION['user_logged_in']= TRUE;
	$_SESSION['username'] = $username;
	header('Localation.../view/index.html');
}

else 
{
	$_SESSION['login_failure'] = "Hibás felhasználónév vagy jelszó";
	header('Localation.../view/index.html');
}
 ?>
