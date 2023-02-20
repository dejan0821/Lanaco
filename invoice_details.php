<?php
if(isset($_GET['invoiceId'])) {
    $datbas = new mysqli("localhost", "root", "", "lanaco");
    $invoiceId = $_GET['invoiceId'];
} else {
    header("Location: invoice.php");
    exit();
}

$sql = "SELECT `racun`.`datumRacuna`, `racun`.`brojRacuna`, `racun`.`ukupniIznos`, `racun`.`iznosPDV`, `racun`.`iznosBezPDV`, CONCAT(`radnik`.`ime`, ' ', `radnik`.`prezime`) as `ime_prezime`, `racunstavka`.`kolicina`, `artikl`.`naziv_art`, `racunstavka`.`cijena`
        FROM `racun`
        JOIN `radnik` ON `racun`.`radnikIDizdao` = `radnik`.`radnikID`
        JOIN `racunstavka` ON `racun`.`racun_id` = `racunstavka`.`racun_id`
        JOIN `artikl` ON `racunstavka`.`artikl_id` = `artikl`.`artikl_id`
        WHERE `racun`.`racun_id` = $invoiceId";
        
        $rez = $datbas->query($sql);

if ($rez->num_rows > 0) {
    while ($row = $rez->fetch_assoc()) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Check</title>
    <link href="CSS/style_new_invoice_check.css" rel="stylesheet">
</head>
<body>
<div class="title-container">
<h1>Račun <?php  echo $row['brojRacuna']; ?></h1>
</div>
    <div class="button-container">
    <div class="left-side">
    <div class="left-side-inner">
        
    </div>
</div>
    <div class="right-side">
<form class="add-button" action="invoice.php">
    <input  type="submit" value="Nazad" />
</form>
</div>
</div>

<div class="flex-container">
<div class="link-container">
    <div class="check">
            <p><strong>Broj računa: </strong><?php echo $row['brojRacuna']; ?> </p>
            <p><strong>Datum računa: </strong><?php echo $row['datumRacuna']; ?> </p>
            <p><strong> Izdao: </strong><?php echo $row['ime_prezime']; ?> </p>
</div>
        
</div>
<div class="link-container">
    <div class="check">
            <p><strong>Ukupno bez PDV-a: </strong><?php echo $row['iznosBezPDV']; ?>  KM</p>
            <p><strong>PDV: </strong><?php echo $row['iznosPDV']; ?>  KM</p>
            <p><strong>Ukupno s PDV-om: </strong><?php echo $row['ukupniIznos']; ?>  KM</p>
</div>
        </div>
    <div class="table-container">
    <table class="artikli-table">
    
        <tr>
            <th>Redni broj</th>
            <th>Artikl</th>
            <th>Količina</th>
            <th>Cijena</th>
            <th>Ukupno</th>
        </tr>
        <?php
            $rb = 1;
            $rez = $datbas->query($sql);
            while ($row = $rez->fetch_assoc()) {
            ?>
        <tr>
            <td><?php echo $rb++; ?></td>
            <td><?php echo $row['naziv_art']; ?></td>
            <td><?php echo $row['kolicina']; ?></td>
            <td><?php echo $row['cijena']; ?> KM</td>
            <td><?php echo $row['kolicina'] * $row['cijena']; ?> KM</td>
        </tr>
        <?php 
    } 
    ?>
    </table>
    </div>
    
</div>

</body>
    
</html>
<?php
    }
}
?>