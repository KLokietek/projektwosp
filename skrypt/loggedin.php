<?php

session_start();
if(!isset($_SESSION['logged']))
{
    header('Location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <style>
/* Style The Dropdown Button */
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  margin:auto;
  margin-left: 40%;
  margin-bottom: 200px;
  margin-top: -100px;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr{background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
footer{
    background: rgb(36, 88, 36);
    height:auto;
    width: 100vw;
    font-family:"Open Sans";
    padding-top:    40px;
    color:white;
}
.footer-content{
    display: flex;
    align-items:center;
    justify-content: center;
    flex-direction: column;
    text-align:center;
}
.footer-content h3{
    font-size:1.8rem;
    font-weight:400;
    text-transform: capitalize;
    line-height:3rem;
}
.footer-content p{
    max-width: 500px;
    margin: 10px auto;
    line_height: 28px;
    font-size:14px;
}
.socials{
    list-style:none;
    display:flex;
    align-items:center;
    justify-content:center;
    margin: 1rem 0 3rem 0;
}
.socials li{
    margin:0 10px;
}
.socials a{
    text-decoration:none;
    color:white;
}
.socials a i{
    font-size:1.1rem;
}
.socials a:hover i{
    color:blue;
}
.footer-bottom{
    width:100vw;
    padding: 20px 0;
    text-align: center;
}
.footer-bottom p{
    font-size:14px;
    word-spacing:2px;
    text-transform:capitalize;
}
.footer-bottom span{
    text-transform: uppercase;
    opacity:.4;
    font-weight:200;
}



</style>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img src="https://i.postimg.cc/3NDF97SJ/wosplogo.png" class="logo">
            <nav>
                <ul>
                    <li><a href="">KRS 0000030897</a></li>
                    <li><a href="http://localhost/projektwosp/skrypt/contact.php">KONTAKT</a></li>                   
                    <div class="dropdown">
                    <button class="dropbtn">Mój profil</button>
                    <div class="dropdown-content">
                    <?php
                        if(isset($_SESSION['email'])) {
                            $email = $_SESSION['email'];
                            echo "<p>".$_SESSION['firstName'].$_SESSION['lastName']."</p>";
                        }          
                        ?>
                        <a href="http://localhost/projektwosp/skrypt/create_auction.php">Dodaj aukcje</a>
                        <?php
                        if(isset($_SESSION['email'])) {
                            $email = $_SESSION['email'];
                            echo "<a href='logout.php'> Wyloguj się</a>";}      
                        ?>
            </div>
        </div>
                    </ul>
                </nav>
            
        </div>
        <div class="row">
            <div class="col">
                <h1>AUKCJE WOSP</h1>
            </div>
            <div class="col">
                <div class="slider-box">
                    <input type="radio" name="slider" id="s1" checked>  
                    <input type="radio" name="slider" id="s2">  
                    <input type="radio" name="slider" id="s3">  
                    <input type="radio" name="slider" id="s4">  
                    <input type="radio" name="slider" id="s5">
                    <div class="cards">
                        <label for="s1" id="slide1">
                            <div class="card">
                                <div class="image" id="img">
                                    <img src="https://cdn.pixabay.com/photo/2022/03/26/01/54/lamborghini-7092117_640.jpg" alt="Lambo">
                                </div>
                                <div class="infos">
                                    <span class="title">Przejaz lamborghini aventador</span>
                                    <span class="text">Przejażdżka lambo autostrada wolności przez 2h!</span>
                
                                    <a href="../page/lambo.html"  class="btn-auction">Aukcja</a>
                                </div>
                            </div>
                        </label>
                        <label for="s2" id="slide2">
                            <div class="card">
                                <div class="image" id="img">
                                    <img src="https://cdn.pixabay.com/photo/2018/04/11/09/15/auto-3309967_640.jpg" alt="ferrari">
                                </div>
                                <div class="infos">
                                    <span class="title">Przejazd Ferrari 458 Italia</span>
                                    <span class="text">Całodniowy wypad w góry nowiutkim ferrari 458 italia</span>
                
                                    <a href="../page/ferrari.html"  class="btn-auction">Aukcja</a>
                                </div>
                            </div>
                        </label>
                        <label for="s3" id="slide3">
                            <div class="card">
                                <div class="image" id="img">
                                    <img src="https://cdn.pixabay.com/photo/2020/01/12/16/57/stadium-4760441_640.jpg" alt="madryt">
                                </div>
                                <div class="infos">
                                    <span class="title">Miejsce VIP na mecz Realu Madryt</span>
                                    <span class="text">Dwa bilety na mecz Real Madyt - Fc Barcelona na sektorze VIP!</span>
                
                                    <a href="../page/mecz.html"  class="btn-auction">Aukcja</a>
                                </div>
                            </div>
                        </label>
                        <label for="s4" id="slide4">
                            <div class="card">
                                <div class="image" id="img">
                                    <img src="https://cdn.pixabay.com/photo/2015/05/31/11/18/table-setting-791149_640.jpg" alt="supper">                   
                                </div>
                                <div class="infos">
                                    <span class="title">Kolacja z Marcinem Najmanem</span>
                                    <span class="text">Kolacja z najlepszym pięściarzem na świecie. Restauracja do wyboru na terenie całego kraju!</span>
                
                                    <a href="../page/kolacja.html"  class="btn-auction">Aukcja</a>
                                </div>
                            </div>
                        </label>
                        <label for="s5" id="slide5">
                            <div class="card">
                                <div class="image" id="img">
                                    <img src="https://cdn.pixabay.com/photo/2016/03/05/22/53/amateur-1239387_640.jpg" alt="spend day">                    
                                </div>
                                <div class="infos">
                                    <span class="title">Dzień z Krzysztofem Stanowskim</span>
                                    <span class="text">Tenis, basen, piłka nożna. Wybierzesz co tylko będziesz chciał.</span>
                                    <a href="../page/stano.html" class="btn-auction">Aukcja</a>
                                </div>
                            </div>
                        </label>
                    </div>  
                  </div>   
            </div>
        </div>
    </div>
    <div id="customers">
              <h1>Aukcje</h1>

              <table>
    <tr>
        
        <th>Tytuł</th>
        <th>Opis</th>
        <th>Cena początkowa</th>
        <th>Akcje</th>
    </tr>
    <?php
    // Pobieranie aukcji z bazy danych
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="projektwosp";
    $conn =new mysqli($servername,$username,$password,$dbname);
    $sql = "SELECT * FROM auctions";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["start_price"] . "</td>";
            echo "<td><a href='auction.php?id_auction=" . $row["id_auction"] . "'>sprawdź</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Brak aukcji.</td></tr>";
    }
    ?>
</table>
</div>
 <footer>
    <div class="footer-content">
        <h3>WOŚP AUKCJE</h3>
        <p>Nasze social media</p>
        <ul class="socials">
            <li><a href="https://www.facebook.com/wosp/"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://www.instagram.com/fundacjawosp/"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://twitter.com/fundacjawosp"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.youtube.com/@orkiestra/videos"><i class="fa fa-youtube"></i></a></li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p>copyright &copy;2020 designed by Kacper Jakub</p>
    </div>
 </footer>   


    

</body>
</html>
</body>
</html>