<?php
if(isset($_POST['korisnickoIme'])) {
    $datbas = new mysqli("localhost", "root", "", "lanaco");
    $korisnickoIme = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['korisnickoIme']))));
    $sifra = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['sifra']))));
    $sifra_enkript = password_hash($sifra, PASSWORD_ARGON2I);
   
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Email nije u ispravnom formatu";
    } else {
      $email = htmlspecialchars(strip_tags($email));
      $email = mysqli_real_escape_string($datbas, $email);  
    }

    $sql_query = "SELECT `korisnicko_ime` FROM `korisnik` WHERE `korisnicko_ime` =  '$korisnickoIme'";
    $res = $datbas->query($sql_query);

    if($res->num_rows == 0) {
        $sql_query = "INSERT INTO `korisnik`
        (`korisnicko_ime`, `password`, `email` )
        VALUES
        ('$korisnickoIme', '$sifra_enkript', '$email')";
        $datbas->query($sql_query);

        setcookie('korisnickoIme', $korisnickoIme, time() + 3600);
        header("Location: login.php");
    }

    else {
 
        header("Location: account_already_exists.php");
            $datbas->close();
            die();
    }
    $datbas->close();
}


?>