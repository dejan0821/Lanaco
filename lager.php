<?php
if(isset($_COOKIE['korisnickoIme'])) {
$datbas = new mysqli("localhost", "root", "", "lanaco");

$korisnickoIme = $_COOKIE['korisnickoIme'];
$mysql_query = "SELECT `rolaID` FROM `korisnik` WHERE `korisnicko_ime` = '$korisnickoIme'";
$res = $datbas->query($mysql_query);
$rola = $res->fetch_assoc()['rolaID'];

} else {
    header("Location: login.php");
    exit();
  }

$mysql_query = "SELECT `lager`.`lager_id`, `artikl`.`naziv_art`, `lager`.`raspolozivaKolicina`, `lager`.`lokacija`
FROM `lager`
INNER JOIN `artikl`
ON `lager`.`artikl_id` = `artikl`.`artikl_id`
ORDER BY `lager_id` DESC";

$res = $datbas->query($mysql_query);

if($res->num_rows > 0) { 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lager</title>
    <link href="CSS/style_lager.css" rel="stylesheet">
</head>
<body>
<div class="title-container">
  <h1>Lager</h1>
</div>
    <div class="button-container">
    <div class="left-side">
    <div class="left-side-inner">
    <?php
    if ($rola == 1) {
    ?>
        <form class="add-button" action="lager_add.php">
            <input  type="submit" value="Novi lager" />
        </form>
    <?php
    }
    ?>
    <?php
    if ($rola == 1) {
    ?>
        <form class="add-button" action="edit_lager.php">
            <input  type="submit" value="Nove količine" />
        </form>
    <?php
    }
    ?>
    </div>
</div>
    <div class="right-side">
<form class="add-button" action="logout.php">
    <input  type="submit" value="Logout" />
</form>
</div>
</div>

<div class="flex-container">
    <div class="table-container">
    <table class="artikli-table">
        <tr>
            <th>Lager ID</th>
            <th>Naziv artikla</th>
            <th>Raspoloživa količina</th>
            <th>Lokacija</th>
            <?php
            if ($rola == 1) {
            ?>
            <th></th>
            <?php
            }
            ?>
        </tr>

       <?php
       while($lager = $res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $lager['lager_id'] ?></td>
            <td><?php echo $lager['naziv_art'] ?></td>
            <td><?php echo $lager['raspolozivaKolicina'] ?></td>
            <td><?php echo $lager['lokacija'] ?></td>
            <?php
            if ($rola == 1) {
            ?>
            <td><form action='delete_lager.php' method='post'>
  <input type='hidden' name='id' value='<?php echo $lager['lager_id']; ?>'>
  <input type='submit' name='delete' value='Izbriši'>
</form></td>
            <?php
            }
            ?>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php } else {
        header("Location: no_lager.php");
    }

    $datbas->close();
    ?>
    </div>
    

<div class="link-container">
<form class="form-index" action="worker.php">
            <input type="submit" value="Radnik" />
        </form>   
        <form class="form-index" action="invoice.php">
            <input type="submit" value="Račun" />
        </form>
        <form class="form-index" action="merch_list.php">
            <input  type="submit" value="Artikli" />
        </form>
        
</div>
</div>

</body>
</html>