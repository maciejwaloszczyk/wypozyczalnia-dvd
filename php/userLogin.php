<?php include 'creds.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj się | Wypożyczalnia DVD</title>
    <style>
        input{
            background-color: #111122;
            color:#fff;
        }
    </style>
</head>
<!-- GET: backref address-->
<body style="background-color:#112;color:#fff">
    <form action="" method="POST">
        <input type="email" name="uname" placeholder="Mail"><br>
        <input type="password" name="pswd" placeholder="Hasło"><br>
        <input type="submit" name="log" value="Zaloguj">
    </form>
    <?php 
        if(isset($_POST["log"]))
        {
            $conn=new mysqli("localhost",USER,PASSWD,DBNAME);
            $a=$conn->query("SELECT * FROM users WHERE email='{$_POST["uname"]}' AND password='{$_POST["pswd"]}';")->fetch_all(MYSQLI_ASSOC);
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
