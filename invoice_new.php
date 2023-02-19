<?php
if(isset($_COOKIE['korisnickoIme'])) {
    $datbas = new mysqli("localhost", "root", "", "lanaco");
    $korisnickoIme = $_COOKIE['korisnickoIme'];
    
} else {
    header("Location: login.php");
    exit();
}

if ($datbas->connect_error) {
    die("Konekcija nije uspjela: " . $datbas->connect_error);
}

if(isset($_POST['novi-racun'])) {
  $radnikID = $_POST['radnik'];
  $datumRacuna = $_POST['datum'];
  $brojRacuna = "R-" . time(); 
  
  $sql = "INSERT INTO `racun` (`radnikIDizdao`, `datumRacuna`, `brojRacuna`, `ukupniIznos`, `iznosPDV`, `iznosBezPDV`) 
          VALUES ('$radnikID', '$datumRacuna', '$brojRacuna', '0.00', '0.00', '0.00')";

  if ($datbas->query($sql) === TRUE) {
    $racunID = $datbas->insert_id;
    setcookie("racunID", $racunID, time() + 3600); // postavljanje cookiea
    echo "Novi račun je uspješno kreiran.";
  } else {
    echo "Greška: " . $sql . "<br>" . $datbas->error;
  }
}

if(isset($_POST['dodaj-stavku'])) {
    // čitanje cookiea
    $racunID = $_COOKIE['racunID'];
    $artiklID = $_POST['artikl_id'];
    $kolicina = $_POST['kolicina'];
    $cijena = $_POST['cijena'];
    
    // dodajemo provjeru postoji li racun s odgovarajucim ID-om u tablici racun
   
    $sql = "SELECT * FROM racun WHERE `racun_id` = '$racunID'";
    $result = $datbas->query($sql);
    if (!$result) {
        echo "Greška: " . $sql . "<br>" . $datbas->error;
        exit();
    }
    elseif ($result->num_rows == 0) {
        echo "Greška: racun s ID-om $racunID ne postoji.";
        exit();
    }
    
    // nastavljamo s dodavanjem stavke racuna
    $sql = "INSERT INTO racunstavka ( `racun_id`, `artikl_id`, `kolicina`, `cijena`) VALUES ( '$racunID', '$artiklID', '$kolicina', '$cijena')";

    if ($datbas->query($sql) === TRUE) {
        echo "Nova stavka računa je uspješno dodana.";
    } else {
        echo "Greška: " . $sql . "<br>" . $datbas->error;
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
			<h1>Otvori novi račun</h1>
			<form action="invoice_new.php" method="post" autocomplete="off" >
            
            <label for="radnik"></label>
            <select name="radnik" id="radnik">
            <option value="0">Radnik</option>
  <?php
    $datbas = new mysqli("localhost", "root", "", "lanaco");
    $sql_query = "SELECT `radnik`.`radnikID`, CONCAT(`radnik`.`ime`, ' ', `radnik`.`prezime`) as `ime_prezime` FROM `radnik`";
    $res = $datbas->query($sql_query);
    if($res->num_rows > 0){
      while ($radnik = $res->fetch_assoc()) { 
  ?>
    <option value="<?php echo $radnik['radnikID'] ?>">
      <?php echo $radnik['ime_prezime'] ?>
    </option>
  <?php
      }
    }
  ?>
</select>
                <label for="datum"></label>
                <input type="date" name="datum" placeholder="Datum" id="datum" required>
                <label for="brojRacuna"></label>
                <input type="text" name="brojRacuna" placeholder="Broj računa" id="brojRacuna" >
				<input type="submit" name ="novi-racun" value="Novi račun">
                
                

</form>
                </div>
<div class="add-form">
			<h1>Dodaj stavke računa</h1>
			<form action="invoice_new.php" method="post" autocomplete="off">
            <label for="naziv"></label>
                <select name="artikl_id" id="selektArt">
                <option value="0">Izaberi artikl</option>
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
                
                

</form>
</div>
<div class="add-form">
			<h1>Akcija</h1>
			<form action="invoice_new.php" method="post" autocomplete="off" id="invo-open">
            <input type="submit" value="Poništi račun">
            <input name ="potvrdi-racun" type="submit" value="Potvrdi račun">
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





