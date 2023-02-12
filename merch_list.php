<?php
$datbas = new mysqli("localhost", "root", "", "lanaco");

$mysql_query = "SELECT * FROM `artikl`";

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
    <div class="button-container">
<form class="add-button" action="merch_add.php">
    <input  type="submit" value="Dodaj" />
</form>


<form class="add-button" action="logout.php">
    <input  type="submit" value="Logout" />
</form>
</div>
    <table class="artikli-table">
        <tr>
            <th>Šifra</th>
            <th>Naziv</th>
            <th>Jedinica mjere</th>
            <th>Bar kod</th>
            <th>PLU kod</th>
            <th></th>
            <th></th>
        </tr>

       <?php
       while($artikli = $res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $artikli['sifra_art'] = $artikli['artikl_id'] ?></td>
            <td><?php echo $artikli['naziv_art'] ?></td>
            <td><?php echo $artikli['jedinica_mjere'] ?></td>
            <td><?php echo $artikli['bar_kod'] ?></td>
            <td><?php echo $artikli['plu_kod'] ?></td>
            <td><form action='edit.php' method='post'>
  <input type='hidden' name='id' value='<?php echo $artikli['artikl_id']; ?>'>
  <input type='submit' value='Izmijeni'>
</form></td>
            <td><form action='delete.php' method='post'>
  <input type='hidden' name='id' value='<?php echo $artikli['artikl_id']; ?>'>
  <input type='submit' name='delete' value='Izbriši'>
</form></td>
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

</body>
</html>