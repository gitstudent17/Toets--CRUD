<?php
echo "<h1>Insert kroeg</h1>";
require_once('functions.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Remove the 'kroegcode' from the $_POST array
    $post_data = $_POST;
    unset($post_data['kroegcode']);

    // Test if insert succeeded
    if (insertkroeg($post_data) == true) {
        echo "<script>alert('kroeg is toegevoegd')</script>";
    } else {
        echo '<script>alert("kroeg is NIET toegevoegd")</script>';
    }
}
?>

<html>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Remove the hidden input for biercode -->
            <!-- Add a hidden input for biercode if needed -->
            <!-- <input type="hidden" name="biercode" value="value_here"> -->
            
            <label for="naam">Naam:</label>
            <input type="text" name="naam" required><br>

            <label for="adres">adres:</label>
            <input type="text" name="adres" required><br>

            <label for="alcohol">plaats:</label>
            <input type="text" name="plaats" required><br>

            <input type="submit" name="btn_ins" value="Insert">
        </form>

        <br><br>
        <a href='crud_kroeg.php'>Home</a>
    </body>
</html>
