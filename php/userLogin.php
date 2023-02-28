<?php include 'creds.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie...</title>
</head>
    <?php
        extract($_POST);
        $database_connection=new mysqli("localhost",USER,PASSWD,DBNAME);
        $a=$database_connection->query("SELECT * FROM users WHERE email LIKE '$InputEmail1' AND password LIKE '$InputPassword1';")->fetch_all(MYSQLI_ASSOC);
        $database_connection->close();
        if(Count($a)!=0)
        {
            session_start();
            $_SESSION["user"]=$a[0]["id"];
            header("Location: $bref");
        }
        //ZMIENIĆ PONIŻEJ PO PRZENIESIENIU
        else header("Location: /wypozyczalnia-dvd/pages/login.php?userLoginError=true&bref=$bref");
    ?>
</body>
</html>