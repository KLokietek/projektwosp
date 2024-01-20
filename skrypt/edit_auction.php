<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projektwosp";
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Pobranie danych aukcji do edycji
        $sql = "SELECT * FROM auctions WHERE id_auction = $id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $title = $row["title"];
            $description = $row["description"];
            $start_price = $row["start_price"];
        } else {
            echo "Nie znaleziono aukcji.";
            exit();
        }
    } else {
        echo "Nieprawidłowe żądanie.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["start_price"])) {
        $id = $_POST["id"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $start_price = $_POST["start_price"];

        // Aktualizacja danych aukcji
        $sql = "UPDATE auctions SET title = '$title', description = '$description', start_price = $start_price WHERE id_auction = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Błąd podczas aktualizacji danych aukcji: " . $conn->error;
        }
    } else {
        echo "Wszystkie pola formularza muszą być wypełnione.";
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edytuj aukcję</title>
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        input[type="number"] {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 16px;
            font-size: 14px;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <h2>Edytuj aukcję</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="title">Tytuł:</label>
        <input type="text" name="title" id="title" value="<?php echo $title; ?>" required><br>

        <label for="description">Opis:</label>
        <textarea name="description" id="description" rows="5" required><?php echo $description; ?></textarea><br>

        <label for="start_price">Cena początkowa:</label>
        <input type="number" name="start_price" id="start_price" value="<?php echo $start_price; ?>" required><br>

        <input type="submit" value="Zapisz zmiany">
    </form>
</body>
</html>
