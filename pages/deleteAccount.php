<?php
include('../php/creds.php');
extract($_POST);
// if (isset($_POST['Dalej']))
// {        
//     $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
//     function randomizeCode()
//     {
//         $activation_code = rand(123456, 998765);
//         return $activation_code;
//     }
//     $activation_code = randomizeCode();
//     $codeCheck = $database_connection -> query("SELECT id FROM users WHERE activation_code LIKE '$activation_code'");
//     while(($codeCheck -> fetch_assoc()) != NULL)
//     {
//         $activation_code = randomizeCode();
//     }
//     $updateCode = $database_connection -> query("UPDATE users SET activation_code = '$activation_code' WHERE email LIKE '$InputEmail1'");

//     $from = 'noreply@macwal04.smarthost.pl';
//     $fromName = 'KNSRent - najlepsza wypożyczalnia DVD!'; 
    
//     $subject = "Przypomnienie hasła - KNSRent";

//     $link = 'http://www.macwal04.smarthost.pl/wypozyczalnia-dvd/pages/remindMe2.php?a=' . $activation_code;

//     $htmlContent = file_get_contents("../assets/mailTemplate/mailTemplate_part1.html") . $link . file_get_contents("../assets/mailTemplate/mailTemplate_part2.html") . $link . file_get_contents("../assets/mailTemplate/mailTemplate_part3.html") . $link . file_get_contents("../assets/mailTemplate/mailTemplate_part4.html");
    
//     // Set content-type header for sending HTML email 
//     $headers = "MIME-Version: 1.0" . "\r\n"; 
//     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
    
//     // Additional headers 
//     $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    
//     // Send email
//     if(mail($InputEmail1, $subject, $htmlContent, $headers)){ 
        
//     }else{ 
//        echo '<script>alert("Wystąpił błąd w wysłaniu kodu aktywacji! Zarejestruj się ponownie!")</script>'; 
//     }
//     header("Location: /wypozyczalnia-dvd/pages/login.php?remindMe=true&bref=/wypozyczalnia-dvd/index.php");
// }
if (isset($_POST['Delete']))
{
    session_start();
    $idUser = $_SESSION['user'];
    $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
    $a=$database_connection->query("SELECT * FROM users WHERE id LIKE '$idUser' AND password LIKE '$InputPassword1' AND is_active = 1 AND is_archived = 0;")->fetch_all(MYSQLI_ASSOC);
    if(Count($a)!=0)
    {
        if ($a[0]["is_banned"]==1)
        {
            header("Location: /wypozyczalnia-dvd/pages/login.php?bannedUser=true&bref=$bref");
        }
        {
            $result = $database_connection -> query("UPDATE users SET is_archived = 1 WHERE id = $idUser");
            $database_connection->close();
            session_destroy();
            header("Location: /wypozyczalnia-dvd/index.php");
        }
    }
    else header("Location: /wypozyczalnia-dvd/pages/deleteAccount.php?userLoginError=true");
}
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Wypożyczalnia DVD</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/styles_2.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <?php include "../php/header.php" ?>
        <!-- Page Content-->
        <div class="d-flex">
            <div class="container px-4 py-4 px-lg-10 d-flex align-content-md-center">
                <form method="POST">
                    <div class="mb-3">
                        <label for="InputEmail1" class="form-label">Usuwanie konta</label>
                        <div id="emailHelp" class="form-text">Podaj hasło</div>
                        <input type="password" class="form-control" id="InputPassword1" name="InputPassword1" aria-describedby="PasswordHelp" required>
                        <?php 
                            if (isset($_GET['userLoginError'])) echo '<div class="mb-3"><div id="userLoginError" class="form-text text-danger">Błędne hasło</div></div>';      
                        ?>
                        <div id="emailHelp" class="form-text text-danger">UWAGA! Usunięcie konta jest operacją bezpowrotną!</div>
                    </div>
                    <input type="submit" name="Delete" class="btn btn-danger" value="USUŃ">
                </form>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark navbar fixed-bottom">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">KNS Web Services &copy; Wypożyczalnia DVD 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>