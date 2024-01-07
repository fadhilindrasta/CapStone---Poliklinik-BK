<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}


if ($_POST) {
    //import database
    include("../connection.php");
    $nama_poli = $_POST["name"];
    $keterangan = $_POST["keterangan"];
    $sql = "insert into poli (id,nama_poli,keterangan) values ('','$nama_poli','$keterangan');";
    $result = $database->query($sql);
    $error = '4';
    header("location: poli.php?action=add&error=" . $error);
}
