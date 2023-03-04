<?php include 'creds.php'; ?>
    <?php
        extract($_POST);
        $privileges = "USER";
        $is_banned = 0;
        $is_archived = 0;

        function randomizeCode()
        {
            $activation_code = rand(123456, 998765);
            return $activation_code;
        }
        
        $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $ifExists = $database_connection -> query("SELECT id FROM users WHERE username LIKE '$InputLogin1'");

        $activation_code = randomizeCode();
        $codeCheck = $database_connection -> query("SELECT id FROM users WHERE activation_code LIKE '$activation_code'");
        while(($codeCheck -> fetch_assoc()) != NULL)
        {
            $activation_code = randomizeCode();
        }

        if (($ifExists -> fetch_assoc()) != NULL)
        {
            $database_connection->close();
            header("Location: /wypozyczalnia-dvd/pages/register.php?userLoginError=true");
        }
        else
        {
            $result = $database_connection -> query("INSERT INTO users VALUES (NULL,'$InputLogin1', '$InputPassword1', '$InputEmail1', '$privileges', 0, 0, 0, '$activation_code')");
            $_SESSION["user"]=$database_connection->insert_id;
            $database_connection->close();

            $from = 'noreply@macwal04.smarthost.pl';
            $fromName = 'KNSRent - najlepsza wypożyczalnia DVD!'; 
            
            $subject = "Potwierdzenie rejestracji - KNSRent";
        
            $link = 'http://www.macwal04.smarthost.pl/wypozyczalnia-dvd/php/userActivate.php?a=' . $activation_code;
        
            $htmlContent = file_get_contents("../assets/mailTemplate/mailTemplate_part1.html") . $link . file_get_contents("../assets/mailTemplate/mailTemplate_part2.html") . $link . file_get_contents("../assets/mailTemplate/mailTemplate_part3.html") . $link . file_get_contents("../assets/mailTemplate/mailTemplate_part4.html");
            
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
            header("Location: /wypozyczalnia-dvd/pages/login.php?newUser=true&bref=/wypozyczalnia-dvd/index.php");
        }
    ?>