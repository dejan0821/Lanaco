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
if(isset($_POST['id'])) {
    $lager_id = $_POST['id'];
    $sql_query = "SELECT `lager`.`lager_id`, `artikl`.`naziv_art`, `lager`.`raspolozivaKolicina`, `lager`.`lokacija`
    FROM `lager`
    JOIN `artikl`
    ON `lager`.`artikl_id` = `artikl`.`artikl_id`
    WHERE `lager`.`lager_id` = '$lager_id'";
    $res = $datbas->query($sql_query);
    $lager = $res->fetch_assoc();
  }
  


if(!isset($_COOKIE['korisnickoIme'])) {
    header("Location: login.php");
    exit;
}
else {  

if(isset($_POST['edit_lager'])) {
    $lager_id = $lager['lager_id'];
    $artikl_id =  $_POST['id'];
    $raspolozivaKolicina = $_POST['raspolozivaKolicina'];
    if (!filter_var($raspolozivaKolicina, FILTER_VALIDATE_FLOAT)) {
        exit();
    } else {
      $raspolozivaKolicina = htmlspecialchars(strip_tags($raspolozivaKolicina));
      $raspolozivaKolicina = mysqli_real_escape_string($datbas, $raspolozivaKolicina);  
    }
    $lokacija = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['lokacija']))));
  $sql = "UPDATE `lager` SET  `artikl_id` = '$artikl_id', `raspolozivaKolicina` = '$raspolozivaKolicina', `lokacija` = '$lokacija' WHERE `lager_id` = '$lager_id'";
  $datbas->query($sql);

  if ($datbas->query($sql) === TRUE) {
    header('Location: lager.php');
    exit;
  } else {
    echo "Greška prilikom izmjene: " . $datbas->error;
  }
  $datbas->close();

}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lager</title>
    <link href="CSS/style_add_worker.css" rel="stylesheet">
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
			<h1>Izmijeni lager</h1>
			<form action="edit_lager.php" method="post" autocomplete="off">
            <input type="hidden" name="lager_id" value="<?php echo $lager['lager_id'] ?>">
            <select name="id" id="artikl_id">
                    <?php
                    $datbas = new mysqli("localhost", "root", "", "lanaco");
                    $sql_query = "SELECT `artikl_id`, `naziv_art` FROM `artikl` ORDER BY `naziv_art` ASC";
                    $res = $datbas->query($sql_query);
                    if($res->num_rows > 0){
                        while ($artikl = $res->fetch_assoc()) { 
                            $selected = '';
          if($lager['artikl_id'] == $artikl['artikl_id']) {
            $selected = 'selected';
          }
          ?>
                        <option value="<?php echo $artikl['artikl_id'] ?>">
                            <?php echo $artikl['naziv_art'] ?>
                        </option>
                    <?php
                    }
                    }
                    ?>
                    </select>
                    
				<label for="raspolozivaKolicina"></label>
				<input type="text" name="raspolozivaKolicina" placeholder="Raspoloživa količina" id="raspolozivaKolicina" value="<?php echo $lager['raspolozivaKolicina']; ?>">
                <label for="lokacija"></label>
                <input type="text" name="lokacija" placeholder="Lokacija" id="lokacija" value="<?php echo $lager['lokacija']; ?>">
               
				<input type="submit" name="edit_lager" value="Izmijeni">

</form>
</div>
</body>
</html>