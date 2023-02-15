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
      $sql = "DELETE FROM `lager` WHERE `lager_id` = '$id'";
      $res = $datbas->query($sql);
    }

}

$datbas->close();
header("Location: lager.php");
?>