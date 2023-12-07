<?php

/**
 * Haal de inloggegevens binnen met een include functie
 */
include('config/config.php');

/**
 * Maak een datasourcename-string voor het maken van een PDO-object
 */
$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

/**
 * Maak een nieuw PDO object zodat we een verbinding hebben met de database
 */
$pdo = new PDO($dsn, $dbUser, $dbPass);

/**
 * Maak een SELECT-query die alle gegevens uit de tabel Persoon haalt.
 * Sorteer met ORDER BY aflopend(DESC) of oplopend ASC
 */
$sql = "SELECT Voornaam
              ,Tussenvoegsel
              ,Achternaam
              ,Wachtwoord
        FROM  Persoon
        ORDER BY Achternaam ASC";

/**
 * Met de method (functie in de klasse PDO) prepare maak je de 
 * query klaar om uitgevoerd te worden
 */
$statement = $pdo->prepare($sql);

/**
 * Voer nu de geprepareerde sql-query uit op de database
 */
$statement->execute();

/**
 * Haal de geselecteerde records binnen als objecten in een array
 * en stop deze in een variabele $result
 */
$result = $statement->fetchAll(PDO::FETCH_OBJ);

var_dump($result);
/**
 * Maak een variabele aan waarin de rijen komen voor de tabel beneden
 */
$tableRows = "";

/**
 * We doorlopen het $result array met een foreach-loop
 */
foreach ($result as $persoonObject) {
    $tableRows .= "<tr>
                        <td>$persoonObject->Voornaam</td>
                        <td>$persoonObject->Tussenvoegsel</td>
                   </tr>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Weergave personen</title>
</head>
<body>    
    <table>
        <thead>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Wachtwoord</th>
        </thead>
        <tbody>
            <?php echo $tableRows; ?>
        </tbody>
    </table>
</body>
</html>