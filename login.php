<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
    
    <div class="login">
			<h1>Login</h1>
			<form action="login_request.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="korisnickoIme" placeholder="Korisničko ime" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="sifra" placeholder="Šifra" id="password" required>
				<input type="submit" value="Login">

</form>
<p class="link_reg">Nemate nalog? <a href="register.php">Register</a></p>
<p class="link_reg">Zaboravili ste šifru? <a href="new_password.php">Nova šifra</a></p>
</div>

</body>
</html>