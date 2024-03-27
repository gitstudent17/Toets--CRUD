<?php
// auteur: ishika
// functie: algemene functies tbv hergebruik
include_once "config.php";

function connectDb(){
    $servername = "localhost"; // Assuming your database server is running locally
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $dbname = "bier"; // Your beer-related database name
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function getData($table){
    $conn = connectDb();
    $sql = "SELECT * FROM $table";
    $que = $conn->prepare($sql);
    $que->execute();
    $result = $que->fetchAll();
    return $result;
}

function getkroeg($kroegcode){
    $conn = connectDb();
    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE kroegcode = :kroegcode";
    $query = $conn->prepare($sql);
    $query->execute([':kroegcode'=>$kroegcode]);
    $result = $query->fetch();
    return $result;
}

function ovzkroeg(){
    $result = getData(CRUD_TABLE);
    printTable($result);
}

function printTable($result){
    $table = "<table>";
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";  
    }
    foreach ($result as $row) {
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        $table .= "</tr>";
    }
    $table.= "</table>";
    echo $table;
}

function crudkroeg(){
    $txt = "
    <h1>Crud kroeg</h1>
    <nav>
    <a href='insert_kroeg.php'>Toevoegen nieuw kroeg</a>
    </nav><br>";
    echo $txt;
    $result = getData(CRUD_TABLE);
    printCrudkroeg($result);
}

function printCrudkroeg($result){
    $table = "<table>";
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";  
    }
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</th>";
    foreach ($result as $row) {
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        $table .= "<td>
    <form method='post' action='update_kroeg.php?kroegcode=$row[kroegcode]' >      
    <button>Wzg</button>
    </form></td>";
        $table .= "<td>
    <form method='post' action='delete_kroeg.php?kroegcode=$row[kroegcode]' >      
    <button>Verwijder</button>
    </form></td>";
        $table .= "</tr>";
    }
    $table.= "</table>";
    echo $table;
}

function updatekroeg($row){
    $conn = connectDb();
    $sql = "UPDATE " . CRUD_TABLE . "
    SET
        naam = :naam,
        adres = :adres,
        plaats = :plaats
    WHERE kroegcode = :kroegcode
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam'=>$row['naam'],
        ':adres'=>$row['adres'],
        ':plaats'=>$row['plaats'],
        ':kroegcode'=>$row['kroegcode']
    ]);
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function insertkroeg($post){
    $conn = connectDb();
    try {
        $sql = "INSERT INTO " . CRUD_TABLE . " (naam, adres, plaats) VALUES (:naam, :adres, :plaats)";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute([
            ':naam' => $post['naam'],
            ':adres' => $post['adres'],
            ':plaats' => $post['plaats'],
        ]);

        // Verify if the insertion was successful
        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            echo "Error: Insertion failed. No rows affected.";
            return false;
        }
    } catch (PDOException $e) {
        // Handle exceptions
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function deletekroeg($kroegcode){
    $conn = connectDb();
    try {
        $sql = "DELETE FROM " . CRUD_TABLE . " WHERE kroegcode = :kroegcode";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':kroegcode', $kroegcode, PDO::PARAM_INT);
        $stmt->execute();
        $retVal = ($stmt->rowCount() == 1) ? true : false ;
        return $retVal;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>