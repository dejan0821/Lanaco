<?php
if (isset($_POST['sbm'])) {

  $datbas = new mysqli("localhost", "root", "", "lanaco");
    
  $artikl_id =  $_POST['artikl_id'];
    $raspolozivaKolicina = $_POST['raspolozivaKolicina'];
    if (!filter_var($raspolozivaKolicina, FILTER_VALIDATE_FLOAT)) {
        exit();
    } else {
      $raspolozivaKolicina = htmlspecialchars(strip_tags($raspolozivaKolicina));
      $raspolozivaKolicina = mysqli_real_escape_string($datbas, $raspolozivaKolicina);  
    }
    $lokacija = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['lokacija']))));

    $sql_query = 
    "INSERT INTO `lager`
        (`artikl_id`,
        `raspolozivaKolicina`,
        `lokacija`)
    VALUES
        ('$artikl_id', 
        '$raspolozivaKolicina', 
        '$lokacija')";

    $res = $datbas->query($sql_query);
    if ($res) {
        header("Location: lager.php");
    } else {
        echo "Došlo je do greške: " . $datbas->error;
    }
   

    $datbas->close();
}


?>