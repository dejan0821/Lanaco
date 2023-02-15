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

$mysql_query = "SELECT * FROM `artikl`
ORDER BY `naziv_art` ASC";

$res = $datbas->query($mysql_query);

if($res->num_rows > 0) { 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
    <link href="CSS/style_tab.css" rel="stylesheet">
</head>
<body>
<div class="title-container">
  <h1>Artikli</h1>
</div>
    <div class="button-container">
    <?php
    if ($rola == 1) {
    ?>
        <form class="add-button" action="merch_add.php">
            <input  type="submit" value="Dodaj" />
        </form>
    <?php
    }
    ?>
<form class="add-button" action="logout.php">
    <input  type="submit" value="Logout" />
</form>
</div>

<div class="flex-container">
    <div class="table-container">
    <table class="artikli-table">
        <tr>
            <th>Šifra</th>
            <th>Naziv</th>
            <th>Jedinica mjere</th>
            <th>Bar kod</th>
            <th>PLU kod</th>
            <?php
            if ($rola == 1) {
            ?>
            <th></th>
            <?php
            }
            ?>
            <?php
            if ($rola == 1) {
            ?>
            <th></th>
            <?php
            }
            ?>
        </tr>

       <?php
       while($artikli = $res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $artikli['sifra_art'] = $artikli['artikl_id'] ?></td>
            <td><?php echo $artikli['naziv_art'] ?></td>
            <td><?php echo $artikli['jedinica_mjere'] ?></td>
            <td><?php echo $artikli['bar_kod'] ?></td>
            <td><?php echo $artikli['plu_kod'] ?></td>
            <?php
            if ($rola == 1) {
            ?>
            <td><form action='edit.php' method='post'>
            <input type='hidden' name='id' value='<?php echo $artikli['artikl_id']; ?>'>
            <input type='submit' value='Izmijeni'>
            </form></td>
            <?php
            }
            ?>
            <?php
            if ($rola == 1) {
            ?>
            <td><form action='delete.php' method='post'>
  <input type='hidden' name='id' value='<?php echo $artikli['artikl_id']; ?>'>
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
        header("Location: no_merch.php");
    
}

$datbas->close();
?>
</div>

<div class="link-container">
<form class="form-index" action="lager.php">
            <input type="submit" value="Lager" />
        </form>   
        <form class="form-index" action="racun.php">
            <input type="submit" value="Račun" />
        </form>
        <form class="form-index" action="worker.php">
            <input  type="submit" value="Radnik" />
        </form>
        <?php
            if ($rola == 1) {
            ?>
        <form class="form-index" action="admin.php">
            <input  type="submit" value="Admin" />
        </form>
        <?php
            }
            ?>
</div>
</div>

        


</body>
</html>