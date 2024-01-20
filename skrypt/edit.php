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

    // Pobieranie użytkownika o podanym identyfikatorze
    $sql = "SELECT * FROM users WHERE id_user = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Wyświetlanie formularza edycji
        echo "
        <h2>Edytuj użytkownika</h2>
        <form action='update.php' method='POST'>
            <input type='hidden' name='id' value='" . $row["id_user"] . "'>

            <label for='firstName'>Imię:</label>
            <input type='text' name='firstName' value='" . $row["firstName"] . "' required><br>

            <label for='lastName'>Nazwisko:</label>
            <input type='text' name='lastName' value='" . $row["lastName"] . "' required><br>

            <label for='email'>Email:</label>
            <input type='email' name='email' value='" . $row["email"] . "' required><br>

            <label for='pass'>Hasło:</label>
            <input type='password' name='pass' required><br>

            <label for='passwordrepeat'>Powtórz hasło:</label>
            <input type='password' name='passwordrepeat' required><br>

            <input type='submit' value='Zapisz zmiany'>
        </form>
        ";
    } else {
        echo "Użytkownik o podanym identyfikatorze nie istnieje.";
    }
}
?>
