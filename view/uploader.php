<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" href="css/upoader.css">
<style>

.button{
	color: white;
	margin-top: 0px;
    border-radius: 30px 30px 30px 30px;
	width: 180px;
	background-color: #401b58;
  	padding: 14px 25px;
  	text-align: center;
  	text-decoration: none;
  	display: inline-block;

}
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #401b58;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  border-radius: 30px 30px 30px 30px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position:absolute;
  top: 20%;
  left: 45%;
  border: 3px solid #401b58;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=tipus] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=tipus]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}
</style>
</head>
<body>
<div>

	<p align="right">
		<input type="button"	style="width: 210px; right: 500px;" class="open-button"  onclick="openForm()" value="új elem hozzáadása">
 		<input type="button" 	onclick="document.location='logout.php'" class="button" value="Kijelentkezes">
	</p>

	<div class="form-popup" id="myForm">
  <form action="/action_page.php" class="form-container">
    <h1>Feltöltés</h1>

    <label for="email"><b>Neve</b></label>
	<input type="text" placeholder="Ird be a fájl nevét" name="file" required>

    <label for="psw"><b>Tipusa</b></label>
    <input type="tipus" placeholder="Add meg a fájl típusát" name="type" required>

    <button type="submit" class="btn">Feltöltés</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Bezár</button>
  </form>
</div>

<table id="table"><thead><tr>
	<th>ID</th>
	<th>Neptun kód</th>
	<th>Utolsó modosítás</th>
	<th>Méret</th>
	<th>Műveletek</th>
    </thead>
    <tbody>
  <tr>
    <td></td>
	<td></td>
	<td></td>
	<td></td>
    <td ><button type="button" onclick=window.alert("Törölve")>Törlés</button> <button type="button" onclick="document.location='modositas.php'" style="right=550px ;">módosítás</button></td>

 

<style>
#table {
	width:100%;
	border:2px solid black;
    margin-top: 50px;
    margin-left:20px;
  background-color: white;
}
td {
    border:2px solid black;
    text-align: center;
}
</style>
</tbody></table>


<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>


</body>
</html>