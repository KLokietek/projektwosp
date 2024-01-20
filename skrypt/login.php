<?php
session_start();
if((!isset($_POST['email']))||(!isset($_POST['password']))){
    header('Location: index.php');
    exit();
}
require_once "connect.php";      
$conn =@new mysqli($servername, $username, $password, $dbname);
    //obsługuje błąd połączenia z bazą danych
    if($conn->connect_errno!=0)
    {
        echo"Błąd połączenia z bazą danych: ". $conn->connect_errno;
    }
    else
    {
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $email= htmlentities($email,ENT_QUOTES,"UTF-8");
           
            $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
            if($stmt === false) 
            {
                echo"Błąd przygotowania zapytania SQL: " . $conn->error;
                //ustawia zmienne jako ciąg znaków,wykonuje zapytanie w bazie, wyplówa efekt na strone
            }    
            else 
            {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                //wykonuje sprawdzeinie czy zapytanie do bazy danych zostało wykonane prawidłowo
                if($result=$conn->query(sprintf("SELECT * FROM users WHERE email='%s'",
                mysqli_real_escape_string($conn,$email))))
                {
                    $user_count = $result->num_rows;
                //sprawdza czy istnieje user w bazie
                    if($user_count > 0) 
                    {
                        $row = $result->fetch_assoc();
                        if(password_verify($pass,$row['pass']))
                        {
                            $_SESSION['logged']=true;
                            $_SESSION['id']=$row['id'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['pass'] = $row['pass'];   
                            $_SESSION['firstName']=$row['firstName'];                                    
                            $_SESSION['lastName']=$row['lastName'];                                                               
                            unset($_SESSION['blad']);
                            $result->free_result();                       
                            header('Location: loggedin.php');
                        }
                        else 
                        {
                        $_SESSION['blad']='<span style="color:red">Nieprawidłowy email lub haslo!</span>';
                        header('location: index.php');
                        }    
                    } 
                    else 
                    {
                        $_SESSION['blad']='<span style="color:red">Nieprawidłowy email lub haslo!</span>';
                        header('location: index.php');
                    }              
                }           
                else 
                {
                    echo "Błąd zapytania SQL: " . $conn->error;
                }                
            }
            $conn->close();    
        }    
    }
?>
