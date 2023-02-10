<?php include 'creds.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization...</title>
</head>
    <?php 
        if(isset($_POST["log"]))
        {
            $database_connection=new mysqli("localhost",USER,PASSWD,DBNAME);
            $a=$database_connection->query("SELECT * FROM USER WHERE {$_POST["InputEmail1"]}=email AND {$_POST["InputPassword1"]}=haslo;")->fetch_all(MYSQLI_ASSOC);
            $database_connection->close();
            if(Count($a)!=0)
            {
                session_start();
                $_SESSION["user"]=$a[0]["id"];
                echo("<scripts>alert('ERROR!')</scripts>");
                header("Location: {$_GET["bref"]}");

            }
            else echo("<scripts>alert('ERROR!')</scripts>");
        }
    ?>
</body>
</html>