<?php



//import database
include("../connection.php");



if ($_POST) {
    //print_r($_POST);
    $result = $database->query("select * from webuser");

    $nic = $_POST['nic'];
    $oldemail = $_POST["oldemail"];
    $usr_nm = $_POST['username'];
    $name = $_POST['name'];
    $spec = $_POST['id_poli'];
    $alamat = $_POST['alamat'];
    $tele = $_POST['Tele'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $id = $_POST['id00'];

    if ($password == $cpassword) {
        $error = '3';
        $result = $database->query("select dokter.id from dokter inner join webuser on dokter.docusr_nm=webuser.usr_nm where webuser.usr_nm='$usr_nm';");
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
            $sql1 = "update dokter set docusr_nm='$usr_nm',nama='$name',doc_pass='$password',alamat='$alamat',no_hp='$tele',id_poli = $spec where id=$id ;";
            $database->query($sql1);

            $sql1 = "update webuser set usr_nm='$usr_nm' where usr_nm='$oldemail' ;";
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


header("location: dokter.php?action=edit&error=" . $error . "&id=" . $id);
?>



</body>

</html>