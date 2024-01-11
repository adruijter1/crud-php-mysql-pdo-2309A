<?php

    /**
     * We maken verbinding met de database. Dus we includen de databasegegevens
     */
    include('config/config.php');

    /**
     * We maken een datasourcename string om een connectie te maken met de mysql server
     */
    $dsn = "mysql:host=$dbHost;
            dbname=$dbName;
            charset=UTF8";

    /**
     * We maken een nieuw PDO object en hebben nu een verbinding met de
     * MySQL database.
     */
    $pdo = new PDO($dsn, $dbUser, $dbPass);


    /**
     * Check of er op de submitknop is gedrukt van het formulier
     */
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        var_dump($_POST);
        /**
         * We maken een updatequery om de gegevens te kunnen wijzigen in de database
         */
        $sql = "UPDATE Persoon
                SET    Voornaam = :voornaam
                      ,Tussenvoegsel = :tussenvoegsel
                      ,Achternaam = :achternaam
                      ,Wachtwoord = :wachtwoord
                WHERE Id = :id";

        /**
         * We gaan de query geschikt maken voor het PDO-object
         */
        $statement = $pdo->prepare($sql);

        /**
         * We koppelen de $_POST-waarden aan de placeholders in de query
         */
        $statement->bindValue(':voornaam', $_POST['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':tussenvoegsel', $_POST['infix'], PDO::PARAM_STR);
        $statement->bindValue(':achternaam', $_POST['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':wachtwoord', $_POST['password'], PDO::PARAM_STR);
        $statement->bindValue(':id', $_POST['id'], PDO::PARAM_STR);

        /**
         * Voer de query uit op de database
         */
        $statement->execute();

        /**
         * Geef een terugkoppelingsmelding aan de gebruiker
         */
        echo "Het updaten is gelukt";

        /**
         * Stuur door naar de pagina read.php
         */
        header('Refresh: 2.5; url=read.php');
        
        exit();
    }

    /**
     * We maken een query die het record met het meegegeven Id opvraagt
     * uit de database
     */
    $sql = "SELECT Id
                  ,Voornaam
                  ,Tussenvoegsel
                  ,Achternaam
                  ,Wachtwoord
            FROM  Persoon
            WHERE Id = :id";

    /**
     * We prepareren de query zodat hij geschikt is voor de PDO-library
     */
    $statement = $pdo->prepare($sql);

    /**
     * We binden de meegegeven waarde $_GET['id'] aan de 
     * placeholder in de query :id
     */
    $statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    /**
     * Voer de query uit op de database
     */
    $statement->execute();

    /**
     * Haal het result op en maak het beschikbaar
     */
    $result = $statement->fetch(PDO::FETCH_OBJ);

    var_dump($result);

    echo $_GET['id'];
?>
<a href="read.php">terug</a>

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
    <h3>Persoonsgegevens Wijzigen</h3>

    <form method="post" action="update.php">
        <label for="firstname">Voornaam: </label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $result->Voornaam; ?>"><br><br>

        <label for="infix">Tussenvoegsel: </label>
        <input type="text" name="infix" id="infix" value="<?php echo $result->Tussenvoegsel; ?>"><br><br>

        <label for="lastname">Achternaam: </label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $result->Achternaam; ?>"><br><br>

        <label for="password">Wachtwoord: </label>
        <input type="password" name="password" id="password" value="<?php echo $result->Wachtwoord; ?>"><br><br>

        <input type="hidden" name="id" value="<?php echo $result->Id; ?>">

        <input type="submit" value="Verzend">
    </form>

    
</body>
</html>