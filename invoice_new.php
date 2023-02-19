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
    setcookie("racunID", $racunID, 0); 
    echo "Novi račun je uspješno kreiran.";
  } else {
    echo "Greška: " . $sql . "<br>" . $datbas->error;
  }
}

if(isset($_POST['dodaj-stavku'])) {
    $racunID = $_COOKIE['racunID'];
    $artiklID = $_POST['artikl_id'];
    $kolicina = $_POST['kolicina'];
    if (!filter_var($kolicina, FILTER_VALIDATE_FLOAT)) {
        exit();
    } else {
      $kolicina = htmlspecialchars(strip_tags($kolicina));
      $kolicina = mysqli_real_escape_string($datbas, $kolicina); 
    }
    $cijena = $_POST['cijena'];
    if (!filter_var($cijena, FILTER_VALIDATE_FLOAT)) {
        exit();
    } else {
      $cijena = htmlspecialchars(strip_tags($cijena));
      $cijena = mysqli_real_escape_string($datbas, $cijena);
    }

    $artikl_id = $_POST['artikl_id'];
    $kolicina = $_POST['kolicina'];

    $sql_query = "SELECT `raspolozivaKolicina` FROM `lager` WHERE `artikl_id` = $artikl_id";
    $res = $datbas->query($sql_query);
    $raspoloziva = $res->fetch_assoc();

    if ($raspoloziva['raspolozivaKolicina'] >= $kolicina) {
        $sql = "INSERT INTO racunstavka ( `racun_id`, `artikl_id`, `kolicina`, `cijena`) VALUES ( '$racunID', '$artiklID', '$kolicina', '$cijena')";
        if ($datbas->query($sql) === TRUE) {
            echo "Nova stavka računa je uspješno dodana.";
           
        } else {
            echo "Greška: " . $sql . "<br>" . $datbas->error;
        }
        $nova_raspoloziva = $raspoloziva['raspolozivaKolicina'] - $kolicina;
        $update_query = "UPDATE `lager` SET `raspolozivaKolicina` = $nova_raspoloziva WHERE `artikl_id` = $artikl_id";
        $datbas->query($update_query);
    } else {
        echo "Nema dovoljno količine na stanju. Odaberite drugi artikl.";
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
                <input type="number" step="0.01" name="cijena" placeholder="Cijena" id="cijena" required>
				<input type="submit" name ="dodaj-stavku" value="Dodaj stavku">
                
                

</form>
</div>
<div class="add-form">
			<h1>Akcija</h1>
			<form>
                <form>
            <input type="submit" value="Poništi račun">
                </form>
                <form action="invoice_new_check.php" method="post" autocomplete="off" id="invoice_check">
            <input name ="potvrdi-racun" type="submit" value="Potvrdi račun">
                </form>
                </form>
                </div>
<div class="table-container">
<table class="artikli-table">
        <thead>
            <tr>
                <th>Stavka</th>
                <th>Artikl</th>
                <th>Količina</th>
                <th>Cijena</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rowCount = 1;
            while ($i = $res->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $rowCount; ?></td>
                    <td><?php echo $i['naziv_art'] ?></td>
                    <td><?php echo $i['kolicina'] ?></td>
                    <td><?php echo $i['cijena'] ?></td>
                </tr>
                <?php
                
            }
            ?>
        </tbody>
    </table>
</div>
</div>
<script>
function dodajStavku() {
    var table = document.querySelector('.artikli-table');
    var row = table.insertRow();
    var cell1 = row.insertCell();
    var cell2 = row.insertCell();
    var cell3 = row.insertCell();
    var cell4 = row.insertCell();
    let rowCount = table.rows.length;  
    cell1.innerHTML = rowCount.toString();
    cell2.innerHTML = document.getElementById('selektArt').value;
    cell3.innerHTML = document.getElementById('kolicina').value;
    cell4.innerHTML = document.getElementById('cijena').value;

    document.querySelector('form').reset();
}

document.querySelector('input[name="dodaj-stavku"]').addEventListener('click', function(event) {
  /*  event.preventDefault();  */
    dodajStavku();
});
</script>
</body>
</html>





