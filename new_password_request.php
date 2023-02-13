<?php
if(isset($_POST['email'])) {
  $datbas = new mysqli("localhost", "root", "", "lanaco");
  $email = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['email']))));

  $sql_query = "SELECT * FROM `korisnik` WHERE `email` = '$email'";
  $res = $datbas->query($sql_query);

  if($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $korisnickoIme = $row['korisnicko_ime'];

    $novasifra = uniqid();
    $sifra_enkript = password_hash($novasifra, PASSWORD_ARGON2I);

    $sql_query = "UPDATE `korisnik` SET `password` = '$sifra_enkript' WHERE `korisnicko_ime` = '$korisnickoIme'";
    $datbas->query($sql_query);

    $to = $email;
    $subject = "Nova šifra";
    $message = "Poštovani, \n\n Vaša nova šifra je: " . $novasifra;
    $headers = "From: no-reply@warehouse13.com" . "\r\n" .
    "CC: no-reply@warehouse13.com";

    mail($to, $subject, $message, $headers);

    echo "Nova šifra Vam je poslana na email adresu. Kliknite <a href='http://localhost/index.php'>ovdje</a> da se vratite na početnu stranicu.";
  } else {
    echo "Korisnik sa unijetom email adresom ne postoji u bazi.";
  }
}
?>