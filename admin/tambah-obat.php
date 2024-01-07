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
    $nama_obat = $_POST["name"];
    $kemasan = $_POST["kemasan"];
    $harga = $_POST["harga"];
    $sql = "insert into obat (id,nama_obat,kemasan,harga) values ('','$nama_obat','$kemasan','$harga');";
    $result = $database->query($sql);
    $error = '4';
    header("location: obat.php?action=add&error=" . $error);
}
