<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarejestruj się...</title>
</head>
<body>
    <form method="post">
    <label for="username">Nazwa użytkownika: </label>    
    <input type="text" id="username" name="username">
    <label for="password">Hasło: </label>
    <input type="text" id="password" name="password">
    <input type="submit">
    </form>
    <?php
        extract($_POST);
        $database_connection = new mysqli('localhost:3306', 'macwal04_administrator', '$g?nyADN-N6q', 'macwal04_wypozyczalnia-dvd');
        $result = $database_connection -> query('INSERT INTO users');
    ?>
</body>
</html>