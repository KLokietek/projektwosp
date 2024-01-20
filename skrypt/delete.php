<?php
if (isset($_GET["id"])) {
    // Tworzenie połączenia z bazą danych
    
    $servername="localhost";
$username="root";
$password="";
$dbname="projektwosp";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Sprawdzenie połączenia
    if ($conn->connect_error) {
        die("Błąd połączenia z bazą danych: " . $conn->connect_error);
    }

    $id = $_GET["id"];

    // Usuwanie użytkownika o podanym identyfikatorze
    $sql = "DELETE FROM users WHERE id_user = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Błąd podczas usuwania użytkownika: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Nieprawidłowy identyfikator użytkownika.";
}
?>
