<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarejestruj się...</title>
</head>
<body>
    <!--
    <form method="post">
    <label for="username">Nazwa użytkownika: </label>    
    <input type="text" id="username" name="username">
    <label for="password">Hasło: </label>
    <input type="text" id="password" name="password">
    <input type="submit">
    </form>
-->
    <?php
        extract($_POST);
        $username = "example";
        $password = "example";
        $mail_address = "example";
        $privileges = "EXMPL";
        $is_banned = 0;
        $is_archived = 0;

        $database_connection = new mysqli('localhost:3306', 'macwal04_administrator', '$g?nyADN-N6q', 'macwal04_wypozyczalnia-dvd');
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