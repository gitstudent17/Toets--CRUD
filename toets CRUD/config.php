<?php
// auteur: Ishika
// functie: configuratiebestand

if (!defined("DATABASE")) {
    define("DATABASE", "bier"); // Database name for beer-related data
}

if (!defined("SERVERNAME")) {
    define("SERVERNAME", "localhost"); // Server name
}

if (!defined("USERNAME")) {
    define("USERNAME", "root"); // Username for database connection
}

if (!defined("PASSWORD")) {
    define("PASSWORD", ""); // Password for database connection
}

if (!defined("CRUD_TABLE")) {
    define("CRUD_TABLE", "kroeg"); // Table name for beer-related data
}

?>