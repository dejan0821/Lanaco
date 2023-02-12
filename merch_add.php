<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Merchandise</title>
    <link href="CSS/style_add.css" rel="stylesheet">
</head>
<body>
<form  action="merch_add_request.php" method="post">

<div class="input-storage">
 <input required type="text" name="naziv" placeholder="Naziv artikla" id="naziv">
</div>

<div class="input-storage">
 <input type="text" name="jedinicaMjere" placeholder="Jedinica mjere" id="jedinicaMjere">
</div>

<div class="input-storage">
 <input required type="number" name="barKod" placeholder="Bar kod" id="barKod">
</div>

<div class="input-storage">
 <input required type="number" name="pluKod" placeholder="PLU kod" id="pluKod">
</div>
<div class="add-merch">
<input  type="submit" value="Dodaj">
</div>

</form>
</body>
</html>