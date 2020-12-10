<?php
require "../model/logDB.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$asd = new logDB();

$res = $asd->listlog();

?>

<table id="table">
    <tr>
        <th>ID</th>
        <th>Dátum</th>
        <th>Leírás</th>

    </tr>
    <?php
    for ($i=0;$i<count($res);$i++) {
        ?>

        <tr>
            <td><?php echo $res[$i]['ID']; ?></td>
            <td><?php echo $res[$i]['Date']; ?></td>
            <td><?php echo $res[$i]['Log']; ?></td>
        </tr>


        <?php
    }
    ?>
</table>
