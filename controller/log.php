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
        <th>D�tum</th>
        <th>Le�r�s</th>

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
