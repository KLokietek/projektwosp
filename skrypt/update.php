<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdzenie, czy wszystkie pola formularza zostały wypełnione
    if (isset($_POST["id"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["passwordrepeat"])) {
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

        $id = $_POST["id"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $passwordrepeat = $_POST["passwordrepeat"];

        // Sprawdzenie, czy hasła się zgadzają
        if ($pass === $passwordrepeat) {
            // Aktualizacja danych użytkownika
            $sql = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', email = '$email', pass = '$pass', passwordrepeat = '$passwordrepeat' WHERE id_user = $id";

            if ($conn->query($sql) === TRUE) {
                header("Location: admin.php");
                exit();
            } else {
                echo "Błąd podczas aktualizacji danych użytkownika: " . $conn->error;
            }
        } else {
            echo "Podane hasła się nie zgadzają.";
        }

        $conn->close();
    } else {
        echo "Wszystkie pola formularza muszą być wypełnione.";
    }
} else {
    echo "Nieprawidłowe żądanie.";
}
?>
<style>
    background : green;
</style>