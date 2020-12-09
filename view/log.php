<html>

<div style="margin-top: 0px;">
    <?php
   include 'header.php';
    ?>
</div>

<?php
include_once('../controller/log.php');
?>

<div style="width: 10%; margin-left: -10px">
    <?php
    include 'sidebar.html';
    ?>
</div>

<table id="table"><thead><tr>
    <th>ID</th>
	<th>Neptunkód</th>
	<th>Felhasználó Szintje</th>
    </thead>
    <tbody>
    <tr>
    <td>05</td>
    <td> - </td>
    <td>Admin</td>
  </tr>
  <tr>
    <td>01</td>
    <td>UWL4JU</td>
    <td>Hallgató</td>
  </tr>
  <tr>
    <td>02</td>
    <td>ZHX4U5</td>
    <td>Hallgató</td>
  </tr>
  <tr>
    <td>03</td>
    <td> - </td>
    <td>Vendég</td>
  </tr>
  <tr>
    <td>04</td>
    <td>A3LU4X</td>
    <td>Hallgató</td>
  </tr>
 

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

<div>
<?php
    include 'footer.php';
    ?>
</div>
</html>


