<?php include 'creds.php'; ?>
    <?php
        extract($_POST);
        $privileges = "USER";
        $is_banned = 0;
        $is_archived = 0;

        $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $ifExists = $database_connection -> query("SELECT id FROM users WHERE username LIKE '$InputLogin1'");
        var_dump($ifExists -> fetch_assoc());
        if (($ifExists -> fetch_assoc()) != NULL)
        {
            $database_connection->close();
            header("Location: /wypozyczalnia-dvd/register.php?userLoginError=true");
        }
        else
        {
            $result = $database_connection -> query("INSERT INTO users VALUES (NULL,'$InputLogin1', '$InputPassword1', '$InputEmail1', '$privileges', 0, 0)");
            $database_connection->close();
            header("Location: /wypozyczalnia-dvd/index.php");
        }
    ?>