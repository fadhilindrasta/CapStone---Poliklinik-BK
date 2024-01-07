<?php



//import database
include("../connection.php");



if ($_POST) {
    //print_r($_POST);
    $result = $database->query("select * from webuser");
    $name = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    $harga = $_POST['harga'];
    $id = $_POST['id00'];


    //$sql1="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
    $sql1 = "update poli set nama_poli='$name',keterangan='$keterangan'where id=$id ;";
    $database->query($sql1);
    //echo $sql1;
    //echo $sql2;
    $error = '4';
    header("location: poli.php?action=edit&error=" . $error . "&id=" . $id);
} else {
    //header('location: signup.php');
    $error = '3';
    header("location: poli.php?action=edit&error=" . $error . "&id=" . $id);
}


?>



</body>

</html>