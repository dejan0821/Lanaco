<?php

if(isset($_POST['naziv'])) {
    $datbas = new mysqli("localhost", "root", "", "lanaco");

    $naziv = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['naziv']))));
    $jedinicaMjere = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['jedinicaMjere']))));
    $barKod = trim($_POST['barKod']);
    if (!filter_var($barKod, FILTER_VALIDATE_INT)) {
        exit();
    } else {
      $barKod = htmlspecialchars(strip_tags($barKod));
      $barKod = mysqli_real_escape_string($datbas, $barKod);  
    }
    $pluKod = trim($_POST['pluKod']);
    if (!filter_var($pluKod, FILTER_VALIDATE_INT)) {
        exit();
    } else {
      $pluKod = htmlspecialchars(strip_tags($pluKod));
      $pluKod = mysqli_real_escape_string($datbas, $pluKod);  
    }

    $sql_query = 
    "INSERT INTO `artikl`
        (`naziv_art`,
        `jedinica_mjere`,
        `bar_kod`, 
        `plu_kod`)
    VALUES
        ('$naziv', 
        '$jedinicaMjere', 
        '$barKod', 
        '$pluKod')";

    $datbas->query($sql_query);

    $datbas->close();
}

header("Location: merch_list.php");
?>
