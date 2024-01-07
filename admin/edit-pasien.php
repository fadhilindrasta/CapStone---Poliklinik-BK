<?php



//import database
include("../connection.php");



if ($_POST) {
    //print_r($_POST);
    $result = $database->query("select * from webuser");

    $nic = $_POST['nic'];
    $oldusername = $_POST["oldusername"];
    $usr_nm = $_POST['username'];
    $name = $_POST['name'];
    $spec = $_POST['id_poli'];
    $alamat = $_POST['alamat'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['Tele'];
    $no_rm = $_POST['no_rm'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $id = $_POST['id00'];

    if ($password == $cpassword) {
        $error = '3';
        $result = $database->query("select pasien.id from pasien inner join webuser on pasien.pusr_nm=webuser.usr_nm where webuser.usr_nm='$usr_nm';");
        //$resultqq= $database->query("select * from doctor where docid='$id';");
        if ($result->num_rows == 1) {
            $id2 = $result->fetch_assoc()["id"];
        } else {
            $id2 = $id;
        }

        echo $id2 . "jdfjdfdh";
        if ($id2 != $id) {
            $error = '1';
            //$resultqq1= $database->query("select * from doctor where docemail='$email';");
            //$did= $resultqq1->fetch_assoc()["docid"];
            //if($resultqq1->num_rows==1){

        } else {

            //$sql1="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
            $sql1 = "update pasien set pusr_nm='$usr_nm',nama='$name',p_pass='$password',alamat='$alamat',no_ktp='$no_ktp',no_hp='$no_hp',no_rm='$no_rm' where id=$id ;";
            $database->query($sql1);

            $sql1 = "update webuser set usr_nm='$usr_nm' where usr_nm='$oldusername' ;";
            $database->query($sql1);
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


header("location: pasien.php?action=edit&error=" . $error . "&id=" . $id);
?>



</body>

</html>