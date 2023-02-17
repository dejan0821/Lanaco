<?php
if(isset($_COOKIE['korisnickoIme'])) {
$datbas = new mysqli("localhost", "root", "", "lanaco");
$korisnickoIme = $_COOKIE['korisnickoIme'];

} else {
    header("Location: login.php");
    exit();
  }

  if (isset($_POST['dodaj-stavku'])) {
    $datbas = new mysqli("localhost", "root", "", "lanaco");
    $racun_id = 1;
    $artikl_id = $_POST['artikl_id'];
    $kolicina = $_POST['kolicina'];
    $cijena = $_POST['cijena'];

    $sql_query = "SELECT `raspolozivaKolicina` FROM `lager` WHERE `artikl_id` = $artikl_id";
    $res = $datbas->query($sql_query);
    $raspoloziva = $res->fetch_assoc();

if ($raspoloziva['raspolozivaKolicina'] >= $kolicina) {
  $sql = "INSERT INTO `racunstavka`(`racun_id`, `artikl_id`, `kolicina`, `cijena`) VALUES ($racun_id, $artikl_id, $kolicina, $cijena)";
  $datbas->query($sql);

  $nova_raspoloziva = $raspoloziva['raspolozivaKolicina'] - $kolicina;
    $update_query = "UPDATE `lager` SET `raspolozivaKolicina` = $nova_raspoloziva WHERE `artikl_id` = $artikl_id";
    $datbas->query($update_query);
} else {
  echo "Nema dovoljno količine na stanju.";
}

$sql_query = "SELECT `racunstavka`.`stavka_id`, `artikl`.`naziv_art`, `racunstavka`.`kolicina`, `racunstavka`.`cijena`
FROM `racunstavka`
INNER JOIN `artikl` ON `racunstavka`.`artikl_id` = `artikl`.`artikl_id`
WHERE `racunstavka`.`racun_id` = $racun_id";

$res = $datbas->query($sql_query);

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Invoice</title>
    <link href="CSS/style_new_invoice.css" rel="stylesheet">
</head>
<body>
<div class="title-container">
  <h1>Novi račun</h1>
</div>
<div class="button-container">
    
<form class="add-button" action="invoice.php">
    <input  type="submit" value="Nazad" />
</form>
</div>

<div class="flex-container">
<div class="add-form">
			<h1>Kreiraj novi račun</h1>
			<form action="invoice_new.php" method="post" autocomplete="off">
            <label for="naziv"></label>
                <select name="artikl_id" id="selektArt">
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
                <label for="kolicina"></label>
                <input type="text" name="kolicina" placeholder="Količina" id="kolicina" required>
                <label for="cijena"></label>
                <input type="number" name="cijena" placeholder="Cijena" id="cijena" required>
				<input type="submit" name ="dodaj-stavku" value="Dodaj stavku">
                <input type="submit" value="Poništi račun">
                <input type="submit" value="Potvrdi račun">

</form>
</div>

<div class="table-container">
<table class="artikli-table">
        <tr>
            <th>Stavka</th>
            <th>Artikl</th>
            <th>Količina</th>
            <th>Cijena</th>
        </tr>

       <?php
       while($i = $res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $i['stavka_id'] ?></td>
            <td><?php echo $i['naziv_art'] ?></td>
            <td><?php echo $i['kolicina'] ?></td>
            <td><?php echo $i['cijena'] ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>
</div>

</body>
</html>