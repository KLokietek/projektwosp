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
?>

<!DOCTYPE html>
<html>

<head>
    <title>Użytkownicy i Aukcje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4caf50;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
       

        th {
            background-color: #4caf50;
        }

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

        input[type="text"],
        input[type="email"],
        input[type="password"] {
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
    <h1>Panel Administratora</h1>
    <h2>Użytkownicy</h2>

   <!-- Tabela użytkowników -->
<table>
    <tr>
        <th>ID użytkownika</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Akcje</th>
    </tr>
    <?php
    // Pobieranie użytkowników z bazy danych
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_user"] . "</td>";
            echo "<td>" . $row["firstName"] . "</td>";
            echo "<td>" . $row["lastName"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td><a href='edit.php?id=" . $row["id_user"] . "'>Edytuj</a> | <a href='delete.php?id=" . $row["id_user"] . "'>Usuń</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Brak użytkowników.</td></tr>";
    }
    ?>
</table>


    <!-- Formularz dodawania użytkownika -->
    <h2>Dodaj użytkownika</h2>
    <form action="add.php" method="POST">
        <label for="firstName">Imię:</label>
        <input type="text" name="firstName" id="firstName" required><br>

        <label for="lastName">Nazwisko:</label>
        <input type="text" name="lastName" id="lastName" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="pass">Hasło:</label>
        <input type="password" name="pass" id="pass" required><br>

        <label for="passwordrepeat">Powtórz hasło:</label>
        <input type="password" name="passwordrepeat" id="passwordrepeat" required><br>

        <input type="submit" value="Dodaj użytkownika">
    </form>

    <h2>Aukcje</h2>

    <!-- Tabela aukcji -->
<table>
    <tr>
        <th>ID aukcji</th>
        <th>ID użytkownika</th>
        <th>Tytuł</th>
        <th>Opis</th>
        <th>Cena początkowa</th>
        <th>Akcje</th>
    </tr>
    <?php
    // Pobieranie aukcji z bazy danych
    $sql = "SELECT * FROM auctions";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_auction"] . "</td>";
            echo "<td>" . $row["id_user"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["start_price"] . "</td>";
            echo "<td><a href='edit_auction.php?id=" . $row["id_auction"] . "'>Edytuj</a> | <a href='delete_auction.php?id=" . $row["id_auction"] . "'>Usuń</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Brak aukcji.</td></tr>";
    }
    ?>
</table>



</body>

</html>
