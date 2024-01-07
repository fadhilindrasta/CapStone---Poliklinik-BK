<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}


if ($_GET) {
    //import database
    include("../connection.php");
    $id = $_GET["id"];
    $result001 = $database->query("select * from pasien where id=$id;");
    $email = ($result001->fetch_assoc())["pusr_nm"];
    $sql = $database->query("delete from webuser where usr_nm='$email';");
    $sql = $database->query("delete from pasien where pusr_nm='$email';");
    //print_r($email);
    header("location: pasien.php");
}
