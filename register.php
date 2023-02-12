<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<div class="register">
			<h1>Registracija</h1>
			<form action="register_request.php" method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="korisnickoIme" placeholder="Korisničko ime" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="sifra" placeholder="Šifra" id="password" required>
                <label for="confirm_password">
                 <i class="fas fa-lock"></i>
                 </label>
                <input type="password" name="potvrda_sifre" placeholder="Potvrdi šifru" id="confirm_password" required>
                <label for="email">
                 <i class="fas fa-envelope"></i>
                 </label>
                <input type="email" name="email" placeholder="E-mail" id="email" required>
				
				<input type="submit" value="Registracija">

</form>
<p class="link_reg" >Imate nalog? <a href="login.php">Login</a></p>
</div>
<script>
    var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");
    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Šifre se ne podudaraju");
      } else {
        confirm_password.setCustomValidity('');
      }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
</body>
</html>

