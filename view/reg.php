<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reg.css">

<div style="margin-top: -10px; margin-left: -10px;">
    <?php
   include 'header.php';
    ?>
</div>
</head>

<body>
    <div class="box">
      <div class="title">
Regisztráció</div>
    <form>
        <div class="field">
          <input type="text" required placeholder="Neptun kód">
        </div>
<div class="field">
          <input type="password" required placeholder="Jelszó">
        </div>

<div class="field">
    <select class="select" name="userlvl" id="userlvl">
        <option value="def" disabled selected>Felhasználó szintje</option>
        <option value="spec">Nézelödő</option>
        <option value="user">Felhasználó</option>
        <option value="admin">Admin</option>
    </select>
        </div>
        <button type="submit" class="btn" value="Submit" onclick="return Validate()" >Regisztrálás</button>

    </form>
        </div>