<?php


session_start();
/*/
---
Tesztek
---
$_SESSION['userlvl']=1;
/*/

if (session_status()==1) {

}
?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>

<div class="topnav">
    <a class="active" href="#home">Főoldal</a>
    <?php
    if ($_SESSION['userlvl']==2) {
        ?>
        <a href="#user">felhasználó létrehozás</a>
        <a href="#kezelés">Felhasználó kezelés</a>
        <a href="#log">log kezelése</a>
        <a href="#kat">kategóriák kezelése</a>
        <?php
    }

    ?>
    <?php
    if ($_SESSION['userlvl']==1) {
        ?>
        <a href="#kat">kategóriák kezelése</a>
        <?php
    }

    ?>



</div>

<div style="padding-left:16px">
  <h2>Menüsor</h2>
  <p>projekt</p>
</div>

</body>
</html>
<?php
?>