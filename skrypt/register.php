<?php
session_start();
if(isset($_POST["email"]))
{
    $fine=true;
    $name=$_POST['firstName'];
    $surname=$_POST['lastName'];
    $email=$_POST['email'];
    $emailS=filter_var($email,FILTER_SANITIZE_EMAIL);
    $pass1=$_POST['password1'];
    $pass2=$_POST['password2'];
    $passhash= password_hash($pass1,PASSWORD_DEFAULT);
    $secretkey="6LcFomomAAAAAHfg3GSrse9LrfPD5h91WEIAgPx6";
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretkey.'&response='.$_POST['g-recaptcha-response']);
    $replay=json_decode($check,true);
    
    if((strlen($name)<3) || (strlen($name)>20))
    {
        $fine=false;
        $_SESSION['e_firstName'] = '<span style="color:red; font-weight:bold; position:fixed; top:0; left:0; margin:10px;">Imię musi zawierać od 3 do 20 znaków</span>';

        
    } 
    
    if(ctype_alnum($name)==false)
    {
        $fine=false;
        $_SESSION['e_firstName']='<span style="color:red; font-weight:bold; position:fixed; top:-5; left:0; margin:10px;"Imie musi zawierać tylko litery(bez polskich znaków)</span>';
    }
    
    if(ctype_alnum($surname)==false)
    {
        $fine=false;
        $_SESSION['e_lastName']='<span style="color:red; font-weight:bold; position:fixed; top:-10; left:0; margin:10px;">Nazwisko musi składać się z liter(bez Polskich znaków)</span>';
    }
    
    if((filter_var($emailS,FILTER_VALIDATE_EMAIL)==false) || ($emailS!=$email))
    {
        $fine=false;   
        $_SESSION['e_email']='<span style="color:red; font-weight:bold; position:fixed; top:-15; left:0; margin:10px;">podaj poprawny email</span>';      
    }

    if((strlen($pass1)<8))
    {
        $fine=false;
        $_SESSION['e_password1']='<span style="color:red; font-weight:bold; position:fixed; top:-20; left:0; margin:10px;">Hasło musi zawierać przynajmniej 8 znaków</span>';   
    }
    
    if($pass1!=$pass2)
    {
        $fine=false;
        $_SESSION['e_password1']='<span style="color:red; font-weight:bold; position:fixed; top:-25; left:0; margin:10px;">Podane hasła nie są identyczne</span>';    
    }

    if(!isset($_POST['checkbox']))
    {
        $fine=false;
        $_SESSION['e_checkbox']='<span style="color:red; font-weight:bold; position:fixed; top:-30; left:0; margin:10px;">Musisz zaakceptować regulamin</span>';   
    }

    if($replay['success']==false)
    {
        $fine=false;
        $_SESSION['e_bot']='<span style="color:red; font-weight:bold; position:fixed; top:-35; left:0; margin:10px;">Potwierdź że nie jesteś botem</span>';
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
    
        $conn=new mysqli($servername,$username,$password,$dbname);
        if($conn->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            $result=$conn->query("SELECT id_user from users where email='$email'");
            if(!$result) throw new Exception($conn->error);
            $emailcount=$result->num_rows;
            if($emailcount>0)
            {
                $fine=false;
                $_SESSION['e_email']="podany email jest już zajęty";  
            }
            
            if($fine==true)
            {
                if($conn->query("INSERT INTO `users` (`id_user`, `firstName`, `lastName`, `email`, `pass`, `passwordrepeat`) VALUES (NULL, '$name', '$surname', '$email', '$passhash', '$passhash');"))
                {
                    $_SESSION['registersucced']=true;
                    header('Location:login.php');
                }
                else
                {
                    throw new exception($conn->error);
                }
            }
            
            
            $conn->close();
        }
    }
    catch(Exception $e)
    {
        echo '<span style="color:red">Ups coś poszło nie tak!</span>';
        //echo $e;
    }    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">

    <script src="https://kit.fontawesome.com/9b7d54bbb7.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Rejestracja WOŚP</title>
</head>
<body>
     <div class="register">
          <span class="borderLine"></span>
            <form method="POST" action="register.php" autocomplete="off">
                <h1>Zarejestruj się</h1>
                    <div class="input-field">
                        <input type="text" name="firstName" id="firstName">
                        <span>Imie</span>
                        <i class="fa-solid fa-user"></i>
                        <?php
                        if(isset($_SESSION['e_firstName']))
                        {
                            echo'<div class="error">'.$_SESSION['e_firstName'].'</div>';
                            unset($_SESSION['e_firstName']);
                        }
                        ?>
                    </div>
                    <div class="input-field">                    
                        <input type="text" name="lastName" id="lastName">
                        <span>Nazwisko</span>
                        <i class="fa-solid fa-user"></i>
                        <?php
                        if(isset($_SESSION['e_lastName']))
                        {
                            echo'<div class="error">'.$_SESSION['e_lastName'].'</div>';
                            unset($_SESSION['e_lastName']);
                        }
                        ?>
                    </div>
                    <div class="input-field">                   
                        <input type="text" name="email" id="email">
                        <span>Email</span>
                        <i class="fa-solid fa-envelope"></i>
                        <?php
                        if(isset($_SESSION['e_email']))
                        {
                            echo'<div class="error">'.$_SESSION['e_email'].'</div>';
                            unset($_SESSION['e_email']);
                        }
                        ?>
                    </div>
                    <div class="input-field">                    
                        <input type="password" name="password1" id="password1" >
                        <span>Hasło</span>
                        <i class="fa-solid fa-lock"></i>
                        <?php
                        if(isset($_SESSION['e_password1']))
                        {
                            echo'<div class="error">'.$_SESSION['e_password1'].'</div>';
                            unset($_SESSION['e_password1']);
                        }
                        ?>
                    </div>
                    <div class="input-field">       
                        <input type="password" name="password2" id="password2">
                        <span>Powtórz hasło</span>
                        <i class="fa-solid fa-lock"></i>  
                    </div>
                    <div class="">
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <span>Akceptuje regulamin</span>
                        <?php
                        if(isset($_SESSION['e_checkbox']))
                        {
                            echo'<div class="error">'.$_SESSION['e_checkbox'].'</div>';
                            unset($_SESSION['e_checkbox']);
                        }
                        ?>
                    </div>       
                    <div class="g-recaptcha" data-sitekey="6LcFomomAAAAAJhwaC5dkkcCNcaBDahjIbH-w5-s"></div>
                    <?php
                        if(isset($_SESSION['e_bot']))
                        {
                            echo'<div class="error">'.$_SESSION['e_bot'].'</div>';
                            unset($_SESSION['e_bot']);
                        }
                        ?>
                    <input type="submit" name="submit" id="submit" value="Zarejestruj">
                </div>
                
                               
            </form>    
        </div>
    </body>
</html>
