<?php
echo "Radniku dodati istu e-mail adresu koja je upotrijebljena prilikom registracije korisnika!!!";
if(isset($_COOKIE['korisnickoIme'])) {
    $datbas = new mysqli("localhost", "root", "", "lanaco");

    $korisnickoIme = $_COOKIE['korisnickoIme'];
    $mysql_query = "SELECT `rolaID` FROM `korisnik` WHERE `korisnicko_ime` = '$korisnickoIme'";
    $res = $datbas->query($mysql_query);
    $rola = $res->fetch_assoc()['rolaID'];
    if ($rola != 1) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Workers</title>
    <link href="CSS/style_add_worker.css" rel="stylesheet">
</head>
<body>
<div class="title-container">
  <h1>Radnici</h1>
</div>
<div class="button-container">
    
<form class="add-button" action="worker.php">
    <input  type="submit" value="Nazad" />
</form>
</div>

<div class="add-form">
			<h1>Dodaj radnika</h1>
			<form action="worker_add_request.php" method="post" autocomplete="off">
				<label for="prezime"></label>
				<input type="text" name="prezime" placeholder="Prezime" id="prezime" required>
				<label for="ime"></label>
				<input type="text" name="ime" placeholder="Ime" id="ime" required>
                <label for="brojTelefona"></label>
                <input type="number" name="brojTelefona" placeholder="Broj telefona" id="brojTelefona" required>
                <label for="adresa"></label>
                <input type="text" name="adresa" placeholder="Adresa" id="adresa" required>
                <label for="grad"></label>
                <input type="text" name="grad" placeholder="Grad" id="grad" required>
                <label for="email"></label>
                <input type="email" name="email" placeholder="E-mail" id="email" required>
                <label for="jmbg"></label>
                <input type="number" name="jmbg" placeholder="JMBG" id="jmbg" required>
				<label for="dodaj"></label>
				<input type="submit" value="Dodaj">

</form>
</div>
</body>
</html>