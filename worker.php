
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

$mysql_query = "SELECT * FROM `radnik`";

$res = $datbas->query($mysql_query);

if($res->num_rows > 0) { 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workers</title>
    <link href="CSS/style_work.css" rel="stylesheet">
</head>
<body>
<div class="title-container">
  <h1>Radnici</h1>
</div>
    <div class="button-container">
    <?php
    if ($rola == 1) {
    ?>
        <form class="add-button" action="worker_add.php">
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
        <th>Prezime</th>
            <th>Ime</th>

            <th>Broj telefona</th>
           
            <th>Adresa</th>
            <th>Grad</th>
            <th>E-mail</th>
            <th>JMBG</th>
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
       while($radnici = $res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $radnici['prezime'] ?></td>
            <td><?php echo $radnici['ime'] ?></td>
            <td><?php echo $radnici['brojTelefona'] ?></td>
            <td><?php echo $radnici['adresa'] ?></td>
            <td><?php echo $radnici['grad'] ?></td>
            <td><?php echo $radnici['email'] ?></td>
            <td><?php echo $radnici['jmbg'] ?></td>
            <?php
            if ($rola == 1) {
            ?>
            <td><form action='edit_worker.php' method='post'>
            <input type='hidden' name='id' value='<?php echo $radnici['radnikID']; ?>'>
            <input type='submit' value='Izmijeni'>
            </form></td>
            <?php
            }
            ?>
            <?php
            if ($rola == 1) {
            ?>
            <td><form action='delete_worker.php' method='post'>
  <input type='hidden' name='id' value='<?php echo $radnici['radnikID']; ?>'>
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
        header("Location: no_workers.php");
    }

    $datbas->close();
    ?>
    </div>
    

<div class="link-container">
<form class="form-index" action="lager.php">
            <input type="submit" value="Lager" />
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