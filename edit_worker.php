<?php
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

$datbas = new mysqli("localhost", "root", "", "lanaco");

$id = $_POST['id'];



$sql = "SELECT * FROM `radnik` WHERE `radnikID` = '$id'";
$res = $datbas->query($sql);
$radnik = $res->fetch_assoc();  // Varijabla za vrijednost koja se mijenja

if(!isset($_COOKIE['korisnickoIme'])) {
    header("Location: login.php");
    exit;
}
else {  

if(isset($_POST['edit_worker'])) {
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

  $sql = "UPDATE `radnik` SET `prezime` = '$prezime', `ime` = '$ime', `brojTelefona` = '$brojTelefona', `adresa` = '$adresa', `grad` = '$grad', `email` = '$email', `jmbg` = '$jmbg' WHERE `radnikID` = '$id'";
  $res = $datbas->query($sql);

  header("Location: worker.php");
}
}

$datbas->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Workers' Info</title>
    <link href="CSS/style_add.css" rel="stylesheet">
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
			<h1>Izmijeni podatke o radniku</h1>
			<form action="edit_worker.php" method="post" autocomplete="off">
            <input type='hidden' name='id' value='<?php echo $radnik['radnikID']; ?>'>
				<label for="prezime"></label>
				<input type="text" name="prezime" placeholder="Prezime" id="naziv" value="<?php echo $radnik['prezime']; ?>">
				<label for="ime"></label>
				<input type="text" name="ime" placeholder="Ime" id="ime" value="<?php echo $radnik['ime']; ?>">
                <label for="brojTelefona"></label>
                <input type="number" name="brojTelefona" placeholder="Broj telefona" id="brojTelefona" value="<?php echo $radnik['brojTelefona']; ?>">
                <label for="adresa"></label>
                <input type="text" name="adresa" placeholder="Adresa" id="adresa" value="<?php echo $radnik['adresa']; ?>">
                <label for="grad"></label>
                <input type="text" name="grad" placeholder="Grad" id="grad" value="<?php echo $radnik['grad']; ?>">
                <label for="email"></label>
                <input type="email" name="email" placeholder="E-mail" id="email" value="<?php echo $radnik['email']; ?>">
                <label for="jmbg"></label>
                <input type="number" name="jmbg" placeholder="JMBG" id="jmbg" value="<?php echo $radnik['jmbg']; ?>">
				<label for="dodaj"></label>
				<input type="submit" name="edit_worker" value="Izmijeni">

</form>
</div>
</body>
</html>