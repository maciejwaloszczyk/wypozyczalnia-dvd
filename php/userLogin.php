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
        if(isset($_POST["log"]))
        {
            $conn=new mysqli("localhost",USER,PASSWD,DBNAME);
            $a=$conn->query("SELECT * FROM USER WHERE {$_POST["InputEmail1"]}=email AND {$_POST["InputPassword1"]}=haslo;")->fetch_all(MYSQLI_ASSOC);
            $conn->close();
            if(Count($a)!=0)
            {
                session_start();
                $_SESSION["user"]=$a[0]["id"];
                header("Location: {$_GET["bref"]}");
            }
        }
    ?>
</body>
</html>