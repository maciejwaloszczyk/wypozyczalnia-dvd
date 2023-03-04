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
            //session_start();
            $_SESSION["user"]=$database_connection->insert_id;
            $database_connection->close();
            header("Location: /wypozyczalnia-dvd/pages/login.php?newUser=true&bref=/wypozyczalnia-dvd/index.php");
        }
    ?>