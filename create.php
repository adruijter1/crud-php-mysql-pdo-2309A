<?php
    // var_dump($_POST);
    
    include('config/config.php');

    /**
     * Gebruik dubbele quotes om de connectiestring, 
     * gebruik kleine letters voor host en dbname!
     */
    $dsn = "mysql:host=$dbHost;
            dbname=$dbName;
            charset=UTF8";

    /**
     * Maak een nieuw PDO object waarmee je verbinding maakt met de 
     * MySQL-server en de database
     */
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    /**
     * We gaan de $_POST-array waarden schoonmaken
     */
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    /**
     * Maak een insert-query om de ingevulde gegevens in de database 
     * op te slaan
     */
    $sql = "INSERT INTO Persoon (Voornaam
                                ,Tussenvoegsel
                                ,Achternaam
                                ,Wachtwoord)
            VALUES              (:firstname
                                ,:infix
                                ,:lastname
                                ,:password)";

    /**
     * Prepareer de query
     */
    $statement = $pdo->prepare($sql);

    /**
     * Verbind aan de placeholders de $_POST-waarden met de method
     * bindValue()
     */
    $statement->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
    $statement->bindValue(':infix', $_POST['infix'], PDO::PARAM_STR);
    $statement->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
    $statement->bindValue(':password', $_POST['password'], PDO::PARAM_STR);

    /**
     * Voer de query uit in de database
     */
    $statement->execute();

    /**
     * Geef feedback aan de gebruiker
     */
    echo "De gegevens zijn opgeslagen in de database";

    /**
     * Met een header() functie kun je automatisch naar een andere pagina
     * navigeren
     */
    header('Refresh:3.5; url=index.php');

    