<?php
require_once('functions.php');

// Check if the form is submitted
if (isset($_POST['btn_wzg'])) {
    // Get the data from the form
    $updatedData = [
        'naam' => $_POST['naam'],
        'adres' => $_POST['adres'],
        'plaats' => $_POST['plaats'],
        'kroegcode' => $_GET['kroegcode'] // Include the biercode in the updated data
    ];

    // Attempt to update the bier
    if (updatekroeg($updatedData)) {
        echo "<script>alert('Kroeg is gewijzigd.')</script>";
    } else {
        echo '<script>alert("Kroeg is NIET gewijzigd.")</script>';
    }
}

// Check if biercode is provided in the URL
if (isset($_GET['kroegcode'])) {
    $kroegcode = $_GET['kroegcode'];
    $row = getkroeg($kroegcode);

    // Check if data is fetched successfully
    if (!$row) {
        echo "Error: kroeg not found.";
        exit; // or redirect to an error page
    }

    // Check if $row is set before accessing its values
    $naam = isset($row['naam']) ? $row['naam'] : '';
    $adres = isset($row['adres']) ? $row['adres'] : '';
    $plaats = isset($row['plaats']) ? $row['plaats'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig kroeg</title>
</head>
<body>
  <h2>Wijzig kroeg</h2>
  <form method="post">
    <label for="naam">Naam:</label>
    <input type="text" name="naam" required value="<?php echo $naam; ?>"><br>

    <label for="adres">adres:</label>
    <input type="text" name="adres" required value="<?php echo $adres; ?>"><br>

    <label for="plaats">plaats:</label>
    <input type="text" name="plaats" required value="<?php echo $plaats; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='crud_kroeg.php'>Home</a>
</body>
</html>
<?php
} else {
    echo "Geen kroegcode opgegeven<br>";
}
?>
