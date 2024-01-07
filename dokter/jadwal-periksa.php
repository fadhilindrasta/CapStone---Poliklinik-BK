<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Doctors</title>
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
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }



    //import database
    include("../connection.php");
    $userrow = $database->query("select * from dokter where docusr_nm='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["id"];
    $username = $userfetch["nama"];

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
                                    <p class="profile-title"><?php echo substr($username, 0, 13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22)  ?></p>
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
            <td class="menu-btn menu-icon-appoinment">
                <a href="jadwal-periksa.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">Jadwal Periksa</p>
                </a>
    </div>
    </td>
    </tr>


    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="index.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>

                    <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email" list="doctors">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="doctors">';
                        $list11 = $database->query("select  id_poli,nama,alamat,no_hp,docusr_nm from  dokter;");

                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["nama"];
                            $p = $row00["id_poli"];
                            $c = $row00["docusr_nm"];
                            echo "<option value='$d'><br/>";
                            echo "<option value='$p'><br/>";
                            echo "<option value='$c'><br/>";
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
                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Dokter</p>
                </td>
                <td colspan="2">
                    <a href="?action=add&id=none&error=0" class="non-style-link"><button class="login-btn btn-primary btn button-icon" style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Add New</font></button>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top:10px;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Doctors (<?php echo $list11->num_rows; ?>)</p>
                </td>

            </tr>
            <?php
            if ($_POST) {
                $keyword = $_POST["search"];

                $sqlmain = "select * from jadwal_periksa where hari='$keyword' or hari='$keyword' or hari like '$keyword%' or hari like '%$keyword' or hari like '%$keyword%'";
            } else {
                $sqlmain = "select * from jadwal_periksa order by id desc";
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
                                            No
                                        </th>
                                        <th class="table-headin">
                                            Nama Dokter
                                        </th>
                                        <th class="table-headin">
                                            Hari
                                        </th>
                                        <th class="table-headin">
                                            Jam Mulai
                                        </th>

                                        <th class="table-headin">
                                            Jam Selesai
                                        </th>
                                        <th class="table-headin">
                                            Status
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
                                    <a class="non-style-link" href="jadwal-periksa.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    } else {
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $row = $result->fetch_assoc();
                                            $id = $row["id"];
                                            $dok = $row["id_dokter"];
                                            $hari = $row["hari"];
                                            $mulai = $row["jam_mulai"];
                                            $selesai = $row["jam_selesai"];
                                            $status = $row["aktif"];
                                            if ($status == 'y') {
                                                $status_baru = 'Aktif';
                                            } elseif ($status == 'n') {
                                                $status_baru = 'Tidak Aktif';
                                            } else {
                                                $status_baru = 'tidak ditemukan';
                                            }
                                            $spcil_res = $database->query("select nama from dokter where id='$dok'");
                                            $spcil_array = $spcil_res->fetch_assoc();
                                            $nama_doc = $spcil_array["nama"];
                                            $no = 1;
                                            echo '
                                            <tr>
                                        <td> &nbsp;
                                            ' . $no++ . '
                                        </td>
                                        <td> &nbsp;
                                            ' . substr($nama_doc, 0, 30) . '
                                        </td>
                                        <td>
                                        ' . substr($hari, 0, 20) . '
                                    </td>

                                        <td>
                                        ' . substr($mulai, 0, 20) . '
                                        </td>
                                        <td>
                                        ' . substr($selesai, 0, 20) . '
                                        </td>
                                        <td>
                                        ' . substr($status_baru, 0, 20) . '
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        <a href="?action=edit&id=' . $id . '&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Edit</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
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
                        <a class="close" href="jadwal-periksa.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-jadwal-periksa.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="jadwal-periksa.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        } elseif ($action == 'view') {
            $sqlmain = "select * from jadwal_periksa where id='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $id_dok = $row["id_dok"];
            $username = $row["docusr_nm"];
            $addres = $row["alamat"];
            $id_poli = $row['id_poli'];
            $spcil_res = $database->query("select nama_poli from poli where id='$id_poli'");
            $spcil_array = $spcil_res->fetch_assoc();
            $spcil_name = $spcil_array["nama_poli"];
            $tele = $row['no_hp'];

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="jadwal .php">&times;</a>
                        <div class="content">
                            eDoc Web App<br>
                            
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
                                    <label for="spec" class="form-label">Poli : </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $spcil_name . '<br><br>
                            </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Alamat: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $addres . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $tele . '<br><br>
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
                                    <a href="jadwal-periksa.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
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
                    
                        <a class="close" href="jadwal-periksa.php">&times;</a> 
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
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Tambah Dokter</p><br><br>
                                </td>
                            </tr>
                            <tr>
                            <form action="tambah-dokter.php" method="POST" class="add-new-form">
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">Pilih Poli: (Current' . $spcil_name . ')</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="spec" id="" class="box">';


                $list11 = $database->query("select  * from  poli;");

                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $sn = $row00["nama_poli"];
                    $id00 = $row00["id"];
                    echo "<option value=" . $id00 . ">$sn</option><br/>";
                };




                echo     '       </select><br><br>
                                        </td>
                                    </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="nama dokter" required><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="alamat" class="form-label">Alamat: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="alamat" class="input-text" placeholder="NIC Number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" required><br>
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
                                <a class="close" href="jadwal-periksa.php">&times;</a>
                                <div class="content">
                                    
                                    
                                </div>
                                <div style="display: flex;justify-content: center;">
                                
                                <a href="jadwal-periksa.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                                </div>
                                <br><br>
                            </center>
                    </div>
                    </div>
        ';
            }
        } elseif ($action == 'edit') {
            $sqlmain = "select * from jadwal_periksa where id='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();
            $id = $row["id"];
            $dok = $row["id_dokter"];
            $hari = $row["hari"];
            $mulai = $row["jam_mulai"];
            $selesai = $row["jam_selesai"];
            $status = $row["aktif"];
            if ($status == 'y') {
                $status_baru = 'Aktif';
            } elseif ($status == 'n') {
                $status_baru = 'Tidak Aktif';
            } else {
                $status_baru = 'tidak ditemukan';
            }
            $spcil_res = $database->query("select nama from dokter where id='$dok'");
            $spcil_array = $spcil_res->fetch_assoc();
            $nama_doc = $spcil_array["nama"];

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
                            
                                <a class="close" href="jadwal-periksa.php">&times;</a> 
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
                                        Jadwal ID : ' . $id . ' (Auto Generated)<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-jadwal.php" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">  Nama Dokter: </label>
                                            <input type="hidden" value="' . $id . '" name="id00">
                                            <input type="hidden" value="' . $dok . '" name="id_dok">
                                            <input type="hidden" name="hari_lama" value="' . $hari . '" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="text" name="Nama_dokter" class="input-text" readonly placeholder="Nama dokter" value="' . $nama_doc . '" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Email" class="form-label">Hari: (Currently =' . $hari . ')</label>
                                            <input type="hidden" name="hari_lama" value="' . $hari . '" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="Hari" id="" class="box">;
                                                <option value="-">-- Silahkan Pilih Hari --</option><br/>
                                                <option value="Senin">Senin</option><br/>
                                                <option value="Selesa">Selesa</option><br/>
                                                <option value="Rabu">Rabu</option><br/>
                                                <option value="Kamis">Kamis</option><br/>
                                                <option value="Jumat">Jumat</option><br/>
                                                <option value="Sabtu">Sabtu</option><br/>
                                            </select><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                    <td class="label-td" colspan="2">
                                        <label for="jam_mulai" class="form-label">Jam Mulai: (Current =' . $mulai . ')</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="Time" name="jam_mulai" class="input-text" placeholder=" Jam Mulai" value="' . $mulai . '"<br>
                                    </td>
                                    
                                </tr>
                                    <tr>
                                        
                                    <td class="label-td" colspan="2">
                                        <label for="jam_selesai" class="form-label">Jam Selesai: (Current =' . $selesai . ')</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="Time" name="jam_selesai" class="input-text" placeholder=" Jam Selesai" value="' . $selesai . '"<br>
                                    </td>
                                    
                                </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="status" class="form-label">Status : (Current = ' . $status_baru . ')</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="status" id="" class="box">;
                                            <option value=" - ">' . $status_baru . '</option><br/>
                                            <option value="y">Aktif</option><br/>
                                            <option value="n">Tidak Aktif</option><br/>
                                        </select><br><br>
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
                            <a class="close" href="jadwal-periksa.php">&times;</a>
                            <div class="content">
                                
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="jadwal-periksa.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

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