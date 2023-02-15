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
    <title>Add Lager</title>
    <link href="CSS/style_add_lager.css" rel="stylesheet">
</head>
<body>
<div class="title-container">
  <h1>Lager</h1>
</div>
<div class="button-container">
    
<form class="add-button" action="lager.php">
    <input  type="submit" value="Nazad" />
</form>
</div>

<div class="add-form">
			<h1>Dodaj lager</h1>
			<form action="lager_add_request.php" method="post" autocomplete="off">
				<label for="naziv"></label>
                <select name="artikl_id" id="">
                    <?php
                    $datbas = new mysqli("localhost", "root", "", "lanaco");
                    $sql_query = "SELECT `artikl_id`, `naziv_art` FROM `artikl` ORDER BY `naziv_art` ASC";
                    $res = $datbas->query($sql_query);
                    if($res->num_rows > 0){
                        while ($artikl = $res->fetch_assoc()) { ?>
                        <option value="<?php echo $artikl['artikl_id'] ?>">
                            <?php echo $artikl['naziv_art'] ?>
                        </option>
                    <?php
                    }
                    }
                    ?>
                    </select>
                    <label for="raspolozivaKolicina"></label>
				<input type="number" step="any" min="0" name="raspolozivaKolicina" placeholder="Raspoloziva količina" id="raspolozivaKolicina" required>
                <label for="lokacija"></label>
                <input type="text" name="lokacija" placeholder="Lokacija" id="lokacija" required>
				<label for="dodaj"></label>
				<input type="submit" name = "sbm" value="Dodaj">

</form>
</div>
</body>
</html>

