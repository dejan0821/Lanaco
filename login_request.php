<?php
if(isset($_POST['korisnickoIme'])) {
    $datbas = new mysqli("localhost", "root", "", "lanaco");
    $korisnickoIme = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['korisnickoIme']))));
    $sifra = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['sifra']))));

    $mysql_query = "SELECT * FROM `korisnik` WHERE `korisnicko_ime` = '$korisnickoIme'";
    $res = $datbas->query($mysql_query);

    if($res->num_rows == 1) {
        $hash = $res->fetch_assoc()['password'];
      
        if(password_verify($sifra, $hash)) {
            setcookie('korisnickoIme', $korisnickoIme, time() + 3600);
            header("Location: home.php");
            die();
        }
        
        else {
            header("Location: login_error.php");
           
            die();
        }
    }
    else {
        header("Location: login_error.php");
        
            die();
    }
    $datbas->close();
}
?>