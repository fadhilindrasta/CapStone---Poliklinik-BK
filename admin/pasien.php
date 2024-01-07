<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Pasien</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
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


    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin poliklink</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor ">
                <a href="dokter.php" class="non-style-link-menu ">
                    <div>
                        <p class="menu-text">dokter</p>
                </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient">
            <a href="pasien.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">pasien</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-schedule">
            <a href="poli.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">poli</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="obat.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Obat</p>
            </a></div>
        </td>
    </tr>>

    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="dokter.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>

                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Pasien name or No.Rm" list="doctors">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="doctors">';
                        $list11 = $database->query("select nama,no_rm from  pasien;");

                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["nama"];
                            $p = $row00["no_rm"];
                            echo "<option value='$d'><br/>";
                            echo "<option value='$p'><br/>";
                        };

                        echo ' </datalist>';
                        ?>


                        <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                    </form>

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php
                        date_default_timezone_set('Asia/Kolkata');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>

            <tr>
                <td colspan="2" style="padding-top:30px;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Pasien</p>
                </td>
                <td colspan="2">
                    <a href="?action=add&id=none&error=0" class="non-style-link"><button class="login-btn btn-primary btn button-icon" style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Tambah</font></button>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top:10px;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Pasien (<?php echo $list11->num_rows; ?>)</p>
                </td>

            </tr>
            <?php
            if ($_POST) {
                $keyword = $_POST["search"];

                $sqlmain = "select * from pasien where pusr_nm='$keyword' or nama='$keyword' or nama like '$keyword%' or nama like '%$keyword' or nama like '%$keyword%'";
            } else {
                $sqlmain = "select * from pasien order by id desc";
            }



            ?>

            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">
                                            Nama
                                        </th>
                                        <th class="table-headin">
                                            Alamat
                                        </th>
                                        <th class="table-headin">
                                            No.KTP
                                        </th>
                                        <th class="table-headin">
                                            No.HP
                                        </th>
                                        <th class="table-headin">
                                            No.RM
                                        </th>

                                        <th class="table-headin">
                                            Username
                                        </th>
                                        <th class="table-headin">

                                            Fitur
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    $result = $database->query($sqlmain);

                                    if ($result->num_rows == 0) {
                                        echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="dokter.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $docid = $row["id"];
                                            $name = $row["nama"];
                                            $alamat = $row["alamat"];
                                            $no_ktp = $row["no_ktp"];
                                            $no_hp = $row["no_hp"];
                                            $no_rm = $row["no_rm"];
                                            $username = $row["pusr_nm"];
                                            echo '<tr>
                                        <td> &nbsp;
                                            ' . substr($name, 0, 30) . '
                                        </td>
                                        <td>
                                        ' . substr($alamat, 0, 20) . '
                                    </td>

                                        <td>
                                        ' . substr($no_ktp, 0, 20) . '
                                        </td>
                                        <td>
                                        ' . substr($no_hp, 0, 20) . '
                                        </td>
                                        <td>
                                        ' . substr($no_rm, 0, 20) . '
                                        </td>
                                        <td>
                                        ' . substr($username, 0, 20) . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        <a href="?action=edit&id=' . $docid . '&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Edit</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="?action=view&id=' . $docid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id=' . $docid . '&name=' . $name . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
                                        </div>
                                        </td>
                                    </tr>';
                                        }
                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </center>
                </td>
            </tr>



        </table>
    </div>
    </div>
    <?php
    if ($_GET) {

        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'drop') {
            $nameget = $_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="pasien.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-pasien.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="pasien.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $sqlmain = "select * from pasien where id='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["nama"];
            $alamat = $row["alamat"];
            $no_ktp = $row["no_ktp"];
            $no_hp = $row["no_hp"];
            $no_rm = $row["no_rm"];
            $username = $row["pusr_nm"];

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="pasien.php">&times;</a>
                        <div class="content">
                           Poliklink - Web Dev<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Nama Dokter: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $name . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Alamat : </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $alamat . '<br><br>
                            </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">No.Ktp: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $no_ktp . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">No.Hp: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $no_hp . '<br><br>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="no_rm" class="form-label">No.RM: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            ' . $no_rm . '<br><br>
                            </td>
                        </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="username" class="form-label">Username: </label>
                                </td>
                            </tr>
                           
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $username . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="dokter.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        } elseif ($action == 'add') {
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

            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );
            if ($error_1 != '4') {
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                        <a class="close" href="pasien.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">0
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">' .
                    $errorlist[$error_1]
                    . '</td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Tambah Pasien</p><br><br>
                                </td>
                            </tr>
                            <tr>
                            <form action="tambah-pasien.php" method="POST" class="add-new-form">
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="fname" class="input-text" placeholder="Nama Depan" required><br>
                                </td>
                                <td class="label-td" colspan="2">
                                <input type="text" name="lname" class="input-text" placeholder="Nama Belakang" required><br>
                            </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="alamat" class="form-label">Alamat: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="alamat" class="input-text" placeholder="Alamat" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no_ktp" class="form-label">No.KTP: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="no_ktp" class="input-text" placeholder="Nomer KTP" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no_hp" class="form-label">No.HP: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="no_hp" class="input-text" placeholder="Telephone Number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no_rm" class="form-label">No.RM: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="no_rm" class="input-text" placeholder="Nomer Rekam Medis"value="' . $no_rm . '"><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="usr_nm" class="form-label">Username: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="usr_nm" class="input-text" placeholder="Username" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="password" class="form-label">Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Conform Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                </td>
                            </tr>
                            
                
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Add" class="login-btn btn-primary btn">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
            } else {
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            <br><br><br><br>
                                <h2>New Record Added Successfully!</h2>
                                <a class="close" href="pasien.php">&times;</a>
                                <div class="content">
                                    
                                    
                                </div>
                                <div style="display: flex;justify-content: center;">
                                
                                <a href="Pasien.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                                </div>
                                <br><br>
                            </center>
                    </div>
                    </div>
        ';
            }
        } elseif ($action == 'edit') {
            $sqlmain = "select * from pasien where id='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $name = $row["nama"];
            $alamat = $row["alamat"];
            $no_ktp = $row["no_ktp"];
            $no_hp = $row["no_hp"];
            $no_rm = $row["no_rm"];
            $username = $row["pusr_nm"];

            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );

            if ($error_1 != '4') {
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            
                                <a class="close" href="pasien.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">' .
                    $errorlist[$error_1]
                    . '</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Dokter.</p>
                                        Doctor ID : ' . $id . ' (Auto Generated)<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-pasien.php" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">Username: </label>
                                            <input type="hidden" value="' . $id . '" name="id00">
                                            <input type="hidden" name="oldusername" value="' . $username . '" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="text" name="username" class="input-text" placeholder="Username" value="' . $username . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name :</label> <label for="name" class="form-label"style="font-weight: 280;">Masukan Nama Panjang</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="name" class="input-text" placeholder="Nama Depan" value="' . $name . '" required><br>
                                        </td>
                                        
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="alamat" class="form-label">Alamat: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="alamat" class="input-text" placeholder="Alamat" value="' . $alamat . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="no_ktp" class="form-label">No.KTP: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="no_ktp" class="input-text" placeholder="Telephone Number" value="' . $no_ktp . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Telephone: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="' . $no_hp . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="no_rm" class="form-label">No.RM: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="no_rm" class="input-text" placeholder="Nomor Rekam Medis" value="' . $no_rm . '" required><br>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">Conform Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                        </td>
                                    </tr>
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
            } else {
                echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>Edit Successfully!</h2>
                            <a class="close" href="dokter.php">&times;</a>
                            <div class="content">
                                
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="dokter.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';
            };
        };
    };

    ?>
    </div>

</body>

</html>