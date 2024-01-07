<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Doctor</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            header("location: ../login.php");
        }
    } else {
        header("location: ../login.php");
    }



    //import database
    include("../connection.php");



    if ($_POST) {
        //print_r($_POST);
        $result = $database->query("select * from webuser");
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $name = $fname . " " . $lname;
        $address = $_POST['alamat'];
        $nik = $_POST['no_ktp'];
        $no_rm = $_POST['no_rm'];
        $tele = $_POST['no_hp'];
        $usr_nm = $_POST['usr_nm'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if ($password == $cpassword) {
            $error = '3';
            $result = $database->query("select * from webuser where usr_nm='$usr_nm';");
            if ($result->num_rows == 1) {
                $error = '1';
            } else {
                $sql1 = "insert into pasien(nama,alamat,no_ktp,no_hp,no_rm,pusr_nm,p_pass) values('$name','$address','$nik','$tele','$no_rm','$usr_nm',$password);";
                $sql2 = "insert into webuser values('$usr_nm','p')";
                $database->query($sql1);
                $database->query($sql2);

                //echo $sql1;
                //echo $sql2;
                $error = '4';
            }
        } else {
            $error = '2';
        }
    } else {
        //header('location: signup.php');
        $error = '3';
    }


    header("location: pasien.php?action=add&error=" . $error);
    ?>



</body>

</html>