<?php



//import database
include("../connection.php");



if ($_POST) {
    //print_r($_POST);
    $result = $database->query("select * from webuser");
    $name = $_POST['nama'];
    $kemasan = $_POST['kemasan'];
    $harga = $_POST['harga'];
    $id = $_POST['id00'];


    //$sql1="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
    $sql1 = "update obat set nama_obat='$name',kemasan='$kemasan',harga='$harga' where id=$id ;";
    $database->query($sql1);
    //echo $sql1;
    //echo $sql2;
    $error = '4';
    header("location: obat.php?action=edit&error=" . $error . "&id=" . $id);
} else {
    //header('location: signup.php');
    $error = '3';
    header("location: obat.php?action=edit&error=" . $error . "&id=" . $id);
}


?>



</body>

</html>