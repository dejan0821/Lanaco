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
$sql_query = "SELECT a.`artikl_id`, a.`naziv_art`, l.`lager_id`, l.`raspolozivaKolicina`, l.`lokacija` 
              FROM `artikl` a 
              LEFT JOIN `lager` l 
              ON a.`artikl_id` = l.`artikl_id` 
              ORDER BY a.`naziv_art` ASC";
$res = $datbas->query($sql_query);
$art = $res->fetch_all(MYSQLI_ASSOC);
$datbas->close();

if (isset($_POST['artikl_id'])) {
  $artikl_id = $_POST['artikl_id'];
  $datbas = new mysqli("localhost", "root", "", "lanaco");
  $sql_query = "SELECT `raspolozivaKolicina`, `lokacija` FROM `lager` WHERE `artikl_id` = '$artikl_id'";
  $res = $datbas->query($sql_query);
  $lager = $res->fetch_assoc();
  
} else {
  $lager = array('raspolozivaKolicina' => '', 'lokacija' => '');
}

  
 
  if(!isset($_COOKIE['korisnickoIme'])) {
    header("Location: login.php");
    exit;
} else {
    if(isset($_POST['edit_lager'])) {
      
        $artikl_id = $_POST['artikl_id'];
        $raspolozivaKolicina = $_POST['raspolozivaKolicina'];
    if (!filter_var($raspolozivaKolicina, FILTER_VALIDATE_FLOAT)) {
        exit();
    } else {
      $raspolozivaKolicina = htmlspecialchars(strip_tags($raspolozivaKolicina));
      $raspolozivaKolicina = mysqli_real_escape_string($datbas, $raspolozivaKolicina);  
    }
    $lokacija = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['lokacija']))));

        $datbas = new mysqli("localhost", "root", "", "lanaco");
        $sql = "UPDATE `lager` SET `raspolozivaKolicina` = '$raspolozivaKolicina', `lokacija` = '$lokacija' WHERE `artikl_id` = '$artikl_id'";
        $datbas->query($sql);

        if ($datbas->affected_rows > 0) {
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
  <h1>Izmijeni lager</h1>
  <form action="edit_lager.php" method="post" autocomplete="off" id="edit-form">
  <select name="artikl_id" id="artikl_id" onchange="submitForm()">
  <option value="0">Izaberi artikl</option>
    <?php foreach ($art as $a) : ?>
      <?php $selected = ($lager && $a['artikl_id'] == $artikl_id) ? 'selected' : ''; ?>
      <option value="<?php echo $a['artikl_id']; ?>" <?php echo $selected; ?>>
        <?php echo $a['naziv_art']; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <label for="raspolozivaKolicina"></label>
  <input type="text" name="raspolozivaKolicina" placeholder="Raspoloživa količina" value="<?php echo isset($lager['raspolozivaKolicina']) ? $lager['raspolozivaKolicina'] : ''; ?>">
  <label for="lokacija"></label>
  <input type="text" name="lokacija" placeholder="Lokacija" value="<?php echo isset($lager['lokacija']) ? $lager['lokacija'] : ''; ?>">
  <input type="submit" name="edit_lager" value="Izmijeni">
</form>
</div>
<script>
  function submitForm() {
    document.getElementById("edit-form").submit();
  }
</script>
</body>
</html>