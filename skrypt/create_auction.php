<?php
// Sprawdź, czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdź, czy wszystkie pola formularza są wypełnione
    if (isset($_POST["itemName"]) && isset($_POST["itemDescription"]) && isset($_POST["startingPrice"])) {
        // Pobierz dane z formularza
        $itemName = $_POST["itemName"];
        $itemDescription = $_POST["itemDescription"];
        $startingPrice = $_POST["startingPrice"];

        // Połączenie z bazą danych
        $conn = new mysqli("localhost", "root", "", "projektwosp");

        // Sprawdź połączenie z bazą danych
        if ($conn->connect_error) {
            die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
        }

        // Utwórz zapytanie SQL do dodania aukcji do tabeli auctions
        $sql = "INSERT INTO auctions (id_user, title, description, start_price) VALUES (1, '$itemName', '$itemDescription', $startingPrice)";

        // Wykonaj zapytanie do bazy danych
        if ($conn->query($sql) === TRUE) {
            echo "Aukcja została dodana do bazy danych.";
            header('Location:loggedin.php');
        } else {
            echo "Błąd podczas dodawania aukcji: " . $conn->error;
        }

        // Zamknij połączenie z bazą danych
        $conn->close();
    } else {
        echo "Wszystkie pola formularza są wymagane.";
    }
} else {
    echo "Nieprawidłowe żądanie.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dodaj_aukcje</title>
  <link rel="stylesheet" href="../css/create_auction.css">
</head>
<body>
    
        
    <div class="box">
        
        <span class="borderLine"></span>
        <form  method="POST" enctype="multipart/form-data">
            <h1>Dodaj aukcje</h1>
  
            <h2>Przedmiot do licytacji</h2>
            
            
            <label for="itemName">Nazwa przedmiotu:</label>
            <input type="text" name="itemName" id="itemName" required>
            
            <label for="itemDescription">Opis przedmiotu:</label>
            <textarea name="itemDescription" id="itemDescription" required></textarea>
            
            <label for="startingPrice">Cena startowa:</label>
            <input type="number" name="startingPrice" id="startingPrice" step="any" required>
            
            <input type="submit" value="Dodaj aukcję">
        </form>
    </div>
</body>
</html>