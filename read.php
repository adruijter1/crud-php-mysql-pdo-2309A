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