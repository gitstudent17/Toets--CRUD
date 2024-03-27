<?php
// auteur: Ishika
// functie: configuratiebestand

define("DATABASE", "bier");
define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");

define("CRUD_TABLE", "kroeg");

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
    // functie: Programma CRUD bier
    // auteur: ishika   

    // Initialisatie
    include 'functions.php';

    // Main

    // Aanroep functie 
    crudkroeg();
    ?>

</body>
</html>
