<?php include '../php/creds.php'; ?>
    <?php
        extract($_POST);

        $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $result = $database_connection -> query("UPDATE users SET users.password = '$InputPassword1' WHERE activation_code LIKE '$activation_code';");
        header("Location: /wypozyczalnia-dvd/index.php");
    ?>