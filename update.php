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