<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New password</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
<div class="new-password">
  <h1>Zatražite novu šifru</h1>
  <form action="new_password_request.php" method="post">
    <label for="email">
      <i class="fas fa-envelope"></i>
    </label>
    <input type="email" name="email" placeholder="Unesite email" id="email" required>

    <input type="submit" value="Pošalji">
  </form>
  <p class="link_reg">Imate šifru? <a href="login.php">Prijavite se</a></p>
</div>
    
</body>
</html>