<?php include 'creds.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie...</title>
</head>
<body>
    <?php
        extract($_POST);
        $database_connection=new mysqli("localhost",USER,PASSWD,DBNAME);
        $a=$database_connection->query("SELECT * FROM users WHERE email LIKE '$InputEmail1' AND password LIKE '$InputPassword1' AND is_active = 1 AND is_archived = 0;")->fetch_all(MYSQLI_ASSOC);
        if(Count($a)!=0)
        {
            if ($a[0]["is_banned"]==1)
            {
                header("Location: /wypozyczalnia-dvd/pages/login.php?bannedUser=true&bref=$bref");
            }
            else
            {
                session_start();
                $_SESSION["user"]=$a[0]["id"];
                $idUser = $_SESSION['user'];
                $_SESSION["privileges"]=$a[0]["privileges"];
                $b=$database_connection->query("SELECT * FROM rental_data WHERE id_user LIKE '$idUser' AND isReturned = 0 AND date_of_return < CURDATE()")->fetch_all(MYSQLI_ASSOC);
                $database_connection->close();                
                if(Count($b)!=0)
                {
                    ?>
                    <script>
                        alert("Powiadomienie: Użytkownik nie oddał wszystkich płyt DVD na czas!");
                        window.location.replace("<?=$bref?>");
                    </script>
                    <?php
                }
                else header("Location: $bref");
            }    
        }
        //ZMIENIĆ PONIŻEJ PO PRZENIESIENIU
        else header("Location: /wypozyczalnia-dvd/pages/login.php?userLoginError=true&bref=$bref");
    ?>
</body>
</html>