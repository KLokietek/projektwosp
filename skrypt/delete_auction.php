<?php
$servername="localhost";
$username="root";
$password="";
$dbname="projektwosp";
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Usunięcie aukcji z bazy danych
        $sql = "DELETE FROM auctions WHERE id_auction = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Błąd podczas usuwania aukcji: " . $conn->error;
        }
    } else {
        echo "Nieprawidłowe żądanie.";
    }
}

$conn->close();
?>
