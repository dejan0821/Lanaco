<?php
if(isset($_COOKIE['korisnickoIme'])) {
$datbas = new mysqli("localhost", "root", "", "lanaco");
$korisnickoIme = $_COOKIE['korisnickoIme'];
} else {
    header("Location: login.php");
    exit();
  }

$mysql_query = 
"SELECT `racun`.`racun_id`, 
`racun`.`brojRacuna`, 
`racun`.`datumRacuna`, 
`racun`.`ukupniIznos`, 
CONCAT(`radnik`.`ime`, ' ', `radnik`.`prezime`) as ime_prezime
FROM `racun`
JOIN `radnik`
ON `racun`.`radnikIDizdao` = `radnik`.`radnikID`
ORDER BY `racun_id` DESC";

$res = $datbas->query($mysql_query);

if (!$res) {
    die("Greška u izvođenju upita: " . $datbas->error);
  }

if($res->num_rows > 0) { 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="CSS/style_invoice.css" rel="stylesheet">
</head>
<body>
<div class="title-container">
  <h1>Računi</h1>
</div>
<div class="button-container">
    <form class="add-button" action="invoice_new.php">
            <input  type="submit" value="Novi račun" />
        </form>
<form class="add-button" action="logout.php">
    <input  type="submit" value="Logout" />
</form>
</div>

<div class="flex-container">
    <div class="table-container">
    <table class="artikli-table">
        <tr>
            <th>Redni broj</th>
            <th>Račun ID</th>
            <th>Broj računa</th>
            <th>Datum kreiranja</th>
            <th>Ukupna cijena</th>
            <th>Račun izdao</th>
        </tr>

       <?php
       $rb = 1;
       while($invoice = $res->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $rb++ ?></td>
            <td><?php echo $invoice['racun_id'] ?></td>
            <td><?php echo $invoice['brojRacuna'] ?></td>
            <td><?php echo $invoice['datumRacuna'] ?></td>
            <td><?php echo $invoice['ukupniIznos'] ?></td>
            <td><?php echo $invoice['ime_prezime'] ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php } else {
        header("Location: no_invoice.php");
    }

    $datbas->close();
    ?>
   </div>
    

<div class="link-container">
<form class="form-index" action="worker.php">
            <input type="submit" value="Radnik" />
        </form>   
        <form class="form-index" action="lager.php">
            <input type="submit" value="Lager" />
        </form>
        <form class="form-index" action="merch_list.php">
            <input  type="submit" value="Artikli" />
        </form>
        
</div>
</div>
<script>
    function showInvoiceDetails(invoiceId) {
    window.location.href = 'invoice_details.php?invoiceId=' + invoiceId;
}
    var rows = document.querySelectorAll('.artikli-table tr');
    rows.forEach(function(row) {
    row.addEventListener('dblclick', function() {
    var invoiceId = this.querySelector('td:nth-child(2)').textContent;
        showInvoiceDetails(invoiceId);
    });
});
    </script>
</body>
</html>