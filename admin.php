<?php
if(isset($_COOKIE['korisnickoIme'])) {
    $datbas = new mysqli("localhost", "root", "", "lanaco");

    $korisnickoIme = $_COOKIE['korisnickoIme'];
    $mysql_query = "SELECT `rolaID` FROM `korisnik` WHERE `korisnicko_ime` = '$korisnickoIme'";
    $res = $datbas->query($mysql_query);
    $rola = $res->fetch_assoc()['rolaID'];
    if ($rola != 1) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="CSS/style.css">
   
</head>
<body>
<div class="header-img">
        <img src="slike/logo1.png" alt="logo.html">
    </div>

<div class="indeks-btns">
        <form class="form-index" action="register_user.php">
            <input type="submit" value="Novi korisnik" />
        </form>   
        <form class="form-index" action="change_password.php">
            <input type="submit" value="Promjena šifre" />
        </form>
         <form class="form-index" action="merch_list.php">
            <input type="submit" value="Artikli" />
        </form>   
        <form class="form-index" action="lager.php">
            <input type="submit" value="Lager" />
        </form>
        <form class="form-index" action="racun.php">
            <input type="submit" value="Račun" />
        </form>
        <form class="form-index" action="radnik.php">
            <input type="submit" value="Radnik" />
        </form>
        <form class="form-index" action="logout.php">
            <input type="submit" value="Logout" />
        </form>   
    </div>
</body>
</html>