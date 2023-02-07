<?php include 'creds.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarejestruj się...</title>
</head>
<body>
    <?php
        extract($_POST);
        $username = "example";
        $password = "example";
        $mail_address = "example";
        $privileges = "EXMPL";
        $is_banned = 0;
        $is_archived = 0;

        $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $ifExists = $database_connection -> query("SELECT id FROM users WHERE username LIKE '$username'");
        if (($ifExists -> fetch_assoc()) != NULL)
        {
            echo "Nazwa użytkownika nie jest dostępna.";
        }
        else
        {
            $result = $database_connection -> query("INSERT INTO users VALUES (NULL,'$username', '$password', '$mail_address', '$privileges', 0, 0)");
        }
    ?>
</body>
</html>