<?php include 'creds.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktywuj konto</title>
</head>
<body>
    <?php
        extract($_GET);
        $privileges = "USER";
        $is_banned = 0;
        $is_archived = 0;
        $activation_code = $a;
    
        $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $ifExists = $database_connection -> query("SELECT id FROM users WHERE activation_code LIKE '$activation_code'");
        if (sizeof($ifExists -> fetch_assoc()) != NULL)
        {
            $result = $database_connection -> query("UPDATE users SET is_active = 1 WHERE activation_code LIKE '$activation_code'");
            $database_connection -> close();
        }
        else
        {
            echo "Błąd kodu!";
        }
    ?>
</body>
</html>