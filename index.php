<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>CRUD</title>
</head>
<body>
    <h3>CRUD met PHP, MySQL en PDO</h3>

    <form method="post" action="create.php">
        <label for="firstname">Voornaam: </label>
        <input type="text" name="firstname" id="firstname"><br><br>

        <label for="infix">Tussenvoegsel: </label>
        <input type="text" name="infix" id="infix"><br><br>

        <label for="lastname">Achternaam: </label>
        <input type="text" name="lastname" id="lastname"><br><br>

        <label for="password">Wachtwoord: </label>
        <input type="password" name="password" id="password"><br><br>

        <input type="submit" value="Verzend">
    </form>
</body>
</html>