<?php
$datbas = new mysqli("localhost", "root", "", "lanaco");
if(!isset($_COOKIE['korisnickoIme'])) {
    header("Location: login.php");
    exit;
}
else {  
    if(isset($_POST['delete'])) {
        $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        if($id === false) {
            exit();
        }
      $sql = "DELETE FROM `radnik` WHERE `radnikID` = '$id'";
      $res = $datbas->query($sql);
    }

}

$datbas->close();
header("Location: merch_list.php");
?>