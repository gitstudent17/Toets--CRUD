<?php
// auteur: ishika
// functie: verwijder een bier op basis van de biercode
include 'functions.php';

// Haal bier uit de database
if(isset($_GET['kroegcode'])){

    // test of insert gelukt is
    $kroegcode = $_GET['kroegcode'];
    $result = deletekroeg($kroegcode);

    if ($result) {
        echo '<script>alert("Kroeg met kroegcode: ' . $kroegcode . ' is verwijderd")</script>';
        echo "<script> location.replace('crud_kroeg.php'); </script>";
    } else {
        echo '<script>alert("Bier met kroegcode: ' . $kroegcode . ' is NIET verwijderd")</script>';
    }
}
?>
