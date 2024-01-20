<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $passwordrepeat = $_POST["passwordrepeat"];

    // Dodawanie nowego użytkownika do bazy danych
    $sql = "INSERT INTO users (firstName, lastName, email, pass, passwordrepeat) VALUES ('$firstName', '$lastName', '$email', '$pass', '$passwordrepeat')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Błąd podczas dodawania użytkownika: " . $conn->error;
    }
}

$conn->close();
?>
