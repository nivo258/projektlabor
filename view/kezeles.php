<html>

<div style="margin-top: 0px;">
    <?php
   include 'header.php';
    ?>
</div>


<div style="width: 10%; margin-left: -10px">
    <?php
    include 'sidebar.html';
    ?>
</div>

<table id="table"><thead><tr>
	<th>Neptunkód</th>
	<th>Felhasználó Szintje</th>
	<th>módosítás</th>
    </thead>
    <tbody>
  <tr>
    <td></td>
    <td></td>
    <td ><button type="button" onclick="document.location='modositas.php'">Törlés</button> <button type="button" onclick="document.location='modositas.php'" style="right=550px ;">módosítás</button></td>

    <?php
    //include_once(../controller/listusers.php)
    ?>
<style>
#table {
	width:80%;
	border:2px solid black;
    margin-top: 50px;
    margin-left: 250px;
  background-color: white;
}
td {
    border:2px solid black;
    text-align: center;
}
button {
    background-color:#401b58;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  border-radius: 12px;
}
</style>
</tbody></table>

<div style="background-color: rgb(255, 233, 198)">
<?php 
    include 'footer.php';
    ?>
</div>
</html>


