
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Merchandise</title>
    <link href="CSS/style_add.css" rel="stylesheet">
</head>
<body>
<div class="title-container">
  <h1>Artikli</h1>
</div>
<div class="button-container">
    
<form class="add-button" action="merch_list.php">
    <input  type="submit" value="Nazad" />
</form>
</div>

<div class="add-form">
			<h1>Dodaj artikl</h1>
			<form action="merch_add_request.php" method="post" autocomplete="off">
				<label for="naziv"></label>
				<input type="text" name="naziv" placeholder="Naziv artikla" id="naziv" required>
				<label for="jedinicaMjere"></label>
				<input type="text" name="jedinicaMjere" placeholder="Jedinica mjere" id="jedinicaMjere" required>
                <label for="barKod"></label>
                <input type="number" name="barKod" placeholder="Bar kod" id="barKod" required>
                <label for="pluKod"></label>
                <input type="number" name="pluKod" placeholder="PLU kod" id="pluKod" required>
				<label for="dodaj"></label>
				<input type="submit" value="Dodaj">

</form>
</div>
</body>
</html>

