<?php 
    if(isset($_COOKIE['korisnickoIme'])){
        setcookie('korisnickoIme', '', time() - 3600);
        header("Location: index.php");
    }
?>