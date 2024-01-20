<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Aukcja</title>
  <link rel="stylesheet" href="../css/auction.css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img src="https://i.postimg.cc/3NDF97SJ/wosplogo.png" class="logo">
            <nav>
                <ul>
                    <li><a href="">KRS 0000030897</a></li>                       
                    <li><a href="">KONTAKT</a></li>
                </ul>
            </nav>
            <img src="https://img.icons8.com/?size=512&id=MjD9wmGLwhA2&format=png" class="menu-icon">
        </div>
    <div class="box">
        
        <span class="borderLine"></span>
        <form action="process_bid.php" method="POST">
            <input type="hidden" name="id_auction" value="<?php echo isset($_POST['id_auction']) ? $_POST['id_auction'] : ''; ?>">
            <h1>Aukcja</h1>
  
            <h2>Przedmiot do licytacji</h2>
            <?php
                require_once "connect.php";
                $conn = new mysqli("localhost", "root", "", "projektwosp");
                
                    
                    if ($conn->connect_error) {
                        die("Błąd połączenia: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT * FROM auctions WHERE 'id_auction'=1"; // Przykładowe zapytanie o aukcję o id 1
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '<p>Nazwa przedmiotu: '.$row["title"].'</p>';
                        echo '<p>Aktualna cena: '.$row["start_price"].'</p>';
                    }
                    $conn->close();
                
                
            ?>
  
            <h2>Formularz licytacji</h2>
            <label for="bidAmount">Kwota licytacji:</label>
            <input type="number" name="bidAmount" id="bidAmount" step="any" required>
            <br>
            <input type="submit" value="Licytuj">
        </form>
    </div>
</body>
</html>
