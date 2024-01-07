<?php



//import database
include("../connection.php");



if ($_POST) {
    //print_r($_POST);
    $result = $database->query("select * from webuser");
    $id = $_POST['id00'];
    $id_dok = ['id_dok'];
    $hari = ['Hari'];
    $mulai = ['jam_mulai'];
    $selesai = ['jam_selesai'];
    $status = ['status'];


    //$sql1="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
    $sql1 = "update jadwal_periksa set hari='$hari',jam_mulai='$mulai',jam_selesai='$selesai',status ='$status' where id=$id;";
    $database->query($sql1);
    //echo $sql1;
    //echo $sql2;
    $error = '4';
    header("location: jadwal-periksa.php?action=edit&error=" . $error . "&id=" . $id);
} else {
    //header('location: signup.php');
    $error = '3';
    header("location: jadwal-periksa.php?action=edit&error=" . $error . "&id=" . $id);
}


?>



</body>

</html>