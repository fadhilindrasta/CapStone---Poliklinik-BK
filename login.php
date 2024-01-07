<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">

    <title>Login</title>



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

        $usr_nm = $_POST['username'];
        $password = $_POST['userpassword'];

        $error = '<label for="promter" class="form-label"></label>';

        $result = $database->query("select * from webuser where usr_nm='$usr_nm'");
        if ($result->num_rows == 1) {
            $utype = $result->fetch_assoc()['usertype'];
            if ($utype == 'p') {
                $checker = $database->query("select * from pasien where pusr_nm='$usr_nm' and p_pass='$password'");
                if ($checker->num_rows == 1) {
                    $ambilrm = $database->query("select no_rm from pasien where pusr_nm='$usr_nm'");
                    //   Patient dashbord
                    $_SESSION['user'] = $usr_nm;
                    $_SESSION['usertype'] = 'p';

                    header('location: pasien/index.php');
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">username atau password salah. Silakan isi kembali</label>';
                }
            } elseif ($utype == 'a') {
                $checker = $database->query("select * from admin where usr_nm='$usr_nm' and pass='$password'");
                if ($checker->num_rows == 1) {


                    //   Admin dashbord
                    $_SESSION['user'] = $usr_nm;
                    $_SESSION['usertype'] = 'a';

                    header('location: admin/index.php');
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">username atau password salah. Silakan isi kembali</label>';
                }
            } elseif ($utype == 'd') {
                $checker = $database->query("select * from dokter where docusr_nm='$usr_nm' and doc_pass='$password'");
                if ($checker->num_rows == 1) {


                    //   doctor dashbord
                    $_SESSION['user'] = $usr_nm;
                    $_SESSION['usertype'] = 'd';
                    header('location: dokter/index.php');
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">username atau password salah. Silakan isi kembali</label>';
                }
            }
        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Tidak bisa menemukan akun username ini.</label>';
        }
    } else {
        $error = '<label for="promter" class="form-label">&nbsp;</label>';
    }

    ?>





    <center>
        <div class="container">
            <table border="0" style="margin: 0;padding: 0;width: 60%;">
                <tr>
                    <td>
                        <p class="header-text">Login</p>
                    </td>
                </tr>
                <div class="form-body">
                    <tr>
                        <td>
                            <p class="sub-text">Silakan isi form di bawah untuk login</p>
                        </td>
                    </tr>
                    <tr>
                        <form action="" method="POST">
                            <td class="label-td">
                                <label for="username" class="form-label">Username: </label>
                            </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <input type="text" name="username" class="input-text" placeholder="Username " required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <label for="userpassword" class="form-label">Password: </label>
                        </td>
                    </tr>

                    <tr>
                        <td class="label-td">
                            <input type="Password" name="userpassword" class="input-text" placeholder="Password" required>
                        </td>
                    </tr>


                    <tr>
                        <td><br>
                            <?php echo $error ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" value="Login" class="login-btn btn-primary btn">
                        </td>
                    </tr>
                </div>
                <tr>
                    <td>
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">belum Punya Akun &#63; </label>
                        <a href="registrasi.php" class="hover-link1 non-style-link">Sign Up</a>
                        <br><br><br>
                    </td>
                </tr>




                </form>
            </table>

        </div>
    </center>
</body>

</html>