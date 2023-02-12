<?php
$datbas = new mysqli("localhost", "root", "", "lanaco");

$id = $_POST['id'];



$sql = "SELECT * FROM `artikl` WHERE `artikl_id` = '$id'";
$res = $datbas->query($sql);
$artikl = $res->fetch_assoc();  // Varijabla za vrijednost koja se mijenja

if(!isset($_COOKIE['korisnickoIme'])) {
    header("Location: login.php");
    exit;
}
else {  

if(isset($_POST['edit_artikl'])) {
    $naziv = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['naziv']))));
    $jedinicaMjere = mysqli_real_escape_string($datbas, htmlspecialchars(strip_tags(trim($_POST['jedinicaMjere']))));
    $barKod = trim($_POST['barKod']);
    if (!filter_var($barKod, FILTER_VALIDATE_INT)) {
        exit();
    } else {
      $barKod = htmlspecialchars(strip_tags($barKod));
      $barKod = mysqli_real_escape_string($datbas, $barKod);  
    }
    $pluKod = trim($_POST['pluKod']);
    if (!filter_var($pluKod, FILTER_VALIDATE_INT)) {
        exit();
    } else {
      $pluKod = htmlspecialchars(strip_tags($pluKod));
      $pluKod = mysqli_real_escape_string($datbas, $pluKod);  
    }
  $sql = "UPDATE `artikl` SET `naziv_art` = '$naziv', `jedinica_mjere` = '$jedinicaMjere', `bar_kod` = '$barKod', `plu_kod` = '$pluKod' WHERE `artikl_id` = '$id'";
  $res = $datbas->query($sql);

  header("Location: merch_list.php");
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
    <title>Edit Merchandise</title>
    <link href="CSS/style_add.css" rel="stylesheet">
</head>
<body>
<h2 class="naslov">Izmijeni artikl</h2>
<form  action="edit.php" method="post">
<input type='hidden' name='id' value='<?php echo $artikl['artikl_id']; ?>'>
<div class="input-storage">
 <input required type="text" name="naziv" placeholder="Naziv artikla" id="naziv" value="<?php echo $artikl['naziv_art']; ?>">
</div>
<div class="input-storage">
 <input type="text" name="jedinicaMjere" placeholder="Jedinica mjere" id="jedinicaMjere" value="<?php echo $artikl['jedinica_mjere']; ?>">
</div>
<div class="input-storage">
 <input required type="number" name="barKod" placeholder="Bar kod" id="barKod" value="<?php echo $artikl['bar_kod']; ?>">

</div>
<div class="input-storage">
 <input required type="number" name="pluKod" placeholder="PLU kod" id="pluKod" value="<?php echo $artikl['plu_kod']; ?>">
</div>
<div class="add-merch">
<input  type="submit" name="edit_artikl" value="Izmijeni">
</div>
</form>
</body>
</html>