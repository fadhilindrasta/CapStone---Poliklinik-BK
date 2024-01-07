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
        $spec = $_POST['spec'];
        $name = $_POST['name'];
        $alamat = $_POST['alamat'];
        $tele = $_POST['Tele'];
        $email = $_POST['usr_nm'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if ($password == $cpassword) {
            $error = '3';
            $result = $database->query("select * from webuser where usr_nm='$email';");
            if ($result->num_rows == 1) {
                $error = '1';
            } else {
                $sql1 = "insert into dokter(id_poli,nama,alamat,no_hp,docusr_nm,doc_pass) values('$spec','$name','$alamat','$tele','$email',$cpassword);";
                $sql2 = "insert into webuser values('$email','d')";
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


    header("location: dokter.php?action=add&error=" . $error);
    ?>



</body>

</html>