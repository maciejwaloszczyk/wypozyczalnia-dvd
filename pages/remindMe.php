<?php
include('../php/creds.php');
extract($_POST);
if (isset($_POST['Dalej']))
{        
    $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
    function randomizeCode()
    {
        $activation_code = rand(123456, 998765);
        return $activation_code;
    }
    $activation_code = randomizeCode();
    $codeCheck = $database_connection -> query("SELECT id FROM users WHERE activation_code LIKE '$activation_code'");
    while(($codeCheck -> fetch_assoc()) != NULL)
    {
        $activation_code = randomizeCode();
    }
    $updateCode = $database_connection -> query("UPDATE users SET activation_code = '$activation_code' WHERE email LIKE '$InputEmail1'");

    $from = 'noreply@macwal04.smarthost.pl';
    $fromName = 'KNSRent - najlepsza wypożyczalnia DVD!'; 
    
    $subject = "Przypomnienie hasła - KNSRent";

    $link = 'http://www.macwal04.smarthost.pl/wypozyczalnia-dvd/pages/remindMe2.php?a=' . $activation_code;

    $htmlContent = file_get_contents("../assets/remindTemplate/mailTemplate_part1.html") . $link . file_get_contents("../assets/mailTemplate/mailTemplate_part2.html") . $link . file_get_contents("../assets/mailTemplate/mailTemplate_part3.html") . $link . file_get_contents("../assets/mailTemplate/mailTemplate_part4.html");
    
    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
    
    // Additional headers 
    $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    
    // Send email
    if(mail($InputEmail1, $subject, $htmlContent, $headers)){ 
        
    }else{ 
       echo '<script>alert("Wystąpił błąd w wysłaniu kodu aktywacji! Zarejestruj się ponownie!")</script>'; 
    }
    header("Location: /wypozyczalnia-dvd/pages/login.php?remindMe=true&bref=/wypozyczalnia-dvd/index.php");
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
                        <label for="InputEmail1" class="form-label">Podaj adres e-mail</label>
                        <input type="email" class="form-control" id="InputEmail1" name="InputEmail1" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">Podaj e-mail z którego korzystasz. Prześlemy na niego dalsze instrukcje.</div>
                    </div>
                    <input type="submit" name="Dalej" class="btn btn-theme" value="Dalej">
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