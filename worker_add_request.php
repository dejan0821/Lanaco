<?php

if(isset($_POST['prezime'])) {
    $datbas = new mysqli("localhost", "root", "", "lanaco");

    $prezime = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['prezime']))));
    $ime = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['ime']))));
    $brojTelefona = trim($_POST['brojTelefona']);
    if (!filter_var($brojTelefona, FILTER_VALIDATE_INT)) {
        exit();
    } else {
      $brojTelefona = htmlspecialchars(strip_tags($brojTelefona));
      $brojTelefona = mysqli_real_escape_string($datbas, $brojTelefona);  
    }
    $adresa = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['adresa']))));
    $grad = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['grad']))));
    $email = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['email']))));
    
    $jmbg = trim($_POST['jmbg']);
    if (!filter_var($jmbg, FILTER_VALIDATE_INT)) {
        exit();
    } else {
      $jmbg = htmlspecialchars(strip_tags($jmbg));
      $jmbg = mysqli_real_escape_string($datbas, $jmbg);  
    }

    $sql_query = 
    "INSERT INTO `radnik`
        (`prezime`,
        `ime`,
        `brojTelefona`, 
        `adresa`,
        `grad`,
        `email`,
        `jmbg`,
        `korisnikID`)
    SELECT
        '$prezime', 
        '$ime', 
        '$brojTelefona', 
        '$adresa',
        '$grad',
        '$email',
        '$jmbg',
        `korisnik`.`korisnikID`
    FROM `korisnik`
    WHERE `korisnik`.`email` = '$email'
    UNION
    SELECT
        '$prezime', 
        '$ime', 
        '$brojTelefona', 
        '$adresa',
        '$grad',
        '$email',
        '$jmbg',
        NULL
        WHERE NOT EXISTS (SELECT 1 FROM `korisnik` WHERE `korisnik`.`email` = '$email')";
       
    
    $datbas->query($sql_query);

    if ($datbas->errno) {
        printf("Greška u upitu: %s\n", $datbas->error);
        exit();
    }
    
    $datbas->close();
}

header("Location: worker.php");

?>