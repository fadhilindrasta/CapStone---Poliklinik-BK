<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">

    <title>Create Account</title>
    <style>
        .container {
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com
    //Unset all the server side variables

    session_start();

    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');

    $_SESSION["date"] = $date;


    //import database
    include("connection.php");





    if ($_POST) {

        $result = $database->query("select * from webuser");

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $name = $fname . " " . $lname;
        $address = $_POST['address'];
        $nik = $_POST['no_ktp'];
        $no_rm = $_POST['no_rm'];
        $tele = $_POST['tele'];
        $usr_nm = $_POST['usernm'];
        $newpassword = $_POST['newpassword'];
        $cpassword = $_POST['cpassword'];

        if ($newpassword == $cpassword) {
            $result = $database->query("select * from webuser where usr_nm='$usr_nm';");
            if ($result->num_rows == 1) {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
            } else {
                $database->query("insert into pasien(nama,alamat,no_ktp, no_hp, no_rm,pusr_nm,p_pass) values('$name','$address','$nik','$tele','$no_rm','$usr_nm','$cpassword');");
                $database->query("insert into webuser values('$usr_nm','p')");

                //print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$nic','$dob','$tele');");
                $_SESSION["user"] = $usr_nm;
                $_SESSION["usertype"] = "p";
                $_SESSION["username"] = $name;

                header('Location: pasien/index.php');
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
            }
        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
        }
    } else {
        //header('location: signup.php');
        $error = '<label for="promter" class="form-label"></label>';
    }

    ?>


    <center>
        <div class="container">
            <table border="0" style="width: 69%;">
                <tr>
                    <td colspan="2">
                        <p class="header-text">REGISTRASI</p>
                        <p class="sub-text">Silakan lakukan registrasi dengan mengisi Form Berikut :</p>
                    </td>
                </tr>
                <tr>
                    <form action="" method="POST">
                        <td class="label-td" colspan="2">
                            <label for="name" class="form-label">Nama : </label>
                        </td>
                </tr>
                <tr>
                    <td class="label-td">
                        <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                    </td>
                    <td class="label-td">
                        <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="address" class="form-label">Alamat: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="text" name="address" class="input-text" placeholder="Address" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="no_ktp" class="form-label">NIK: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="tel" name="no_ktp" class="input-text" placeholder="ex: 337413091219880005">
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="tele" class="form-label">Nomor Telephone: </label>
                    </td>
                </tr>

                <tr>
                    <td class="label-td" colspan="2">
                        <input type="tel" name="tele" class="input-text" placeholder="ex: 0812345678912">
                    </td>
                </tr>
                <?php
                $queryGetRm = $database->query("SELECT MAX(SUBSTRING(no_rm,8)) as last_queue_number FROM pasien");
                if (!$queryGetRm) {
                    die("Query gagal :" . $database->connect_error);
                }
                $rowRm = mysqli_fetch_assoc($queryGetRm);
                $lastQueueNumber = $rowRm['last_queue_number'];

                $lastQueueNumber = $lastQueueNumber ? $lastQueueNumber : 0;

                $tahun_bulan = date("Ym");

                $newQueueNumber = $lastQueueNumber + 1;

                $no_rm = $tahun_bulan . "-" . str_pad($newQueueNumber, 3, '0', STR_PAD_LEFT);
                ?>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="no_rm" class="form-label">No.RM: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="Text" name="no_rm" readonly class="input-text" placeholder="ex: 202401-" value="<?= $no_rm ?>">
                    </td>
                </tr>

                <tr>
                    <td class=" label-td" colspan="2">
                        <label for="usernm" class="form-label">Username: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="text" name="usernm" class="input-text" placeholder="Username" ">
                    </td>

                </tr>
                <tr>
                    <td class=" label-td" colspan="2">
                        <label for="newpassword" class="form-label">Buat Password Baru: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" name="newpassword" class="input-text" placeholder="New Password" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="cpassword" class="form-label">Konfirmasi Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required>
                    </td>
                </tr>

                <tr>

                    <td colspan="2">
                        <?php echo $error ?>

                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                    </td>
                    <td>
                        <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                        <a href="login.php" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>

                </form>
                </tr>
            </table>

        </div>
    </center>
</body>

</html>