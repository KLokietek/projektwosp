<?php
    session_start();
    if((isset($_SESSION['logged']))&&($_SESSION['logged'])==true)
    {
        header('Location: loggedin.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_SESSION['blad'])) 
        {
            echo $_SESSION['blad'];
        }
    ?>
    <div class="box">
        <span class="borderLine"></span>    
        <form action="login.php" method="POST" >
            <h2>Aukcje WOŚP</h2>
            <h2>Logowanie</h2>
            <div class="inputBox">
                <input type="text" name="email" id="email" required="required">
                <span>e-mail</span>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" id="password" required="required">
                <span>hasło</span>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="links">
                <a href="#">Zapomniałem hasła</a>
                <a href="http://localhost/projektwosp/skrypt/register.php">Zarejestruj się</a>
            </div>
            <input type="submit" value="Zaloguj" name="submit" id="submit">
        </form>
    </div>
</body>
</html>