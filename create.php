<?php
    var_dump($_POST);
    
    include('config/config.php');

    // Gebruik dubbele quotes om de connectiestring
    $dsn = "mysql:host=$dbHost;
            dbName=$dbName;
            charset=UTF8";

    $pdo = new PDO($dsn, $dbUser, $dbPass);

    $sql = "INSERT INTO Persoon (Voornaam
                                ,Tussenvoegsel
                                ,Achternaam
                                ,Wachtwoord)
            VALUES              ('" . $_POST['firstname'] . "'
                                ,'" . $_POST['infix'] . "'
                                ,'" . $_POST['lastname']. "'
                                ,'" . $_POST['password']. "')";

    echo $sql;

    /**
     * Prepareer de query
     */
    $statement = $pdo->prepare($sql);

    