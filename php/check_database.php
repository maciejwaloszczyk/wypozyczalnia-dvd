<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHECK DATABASE</title>
</head>
<body>
<?php
    $database_connection = new mysqli('localhost:3306', 'macwal04_administrator', '$g?nyADN-N6q', 'macwal04_wypozyczalnia-dvd');
    $result = $database_connection -> query('SELECT * FROM users');
    while($row = $result -> fetch_assoc())
    {
        echo "id: " . $row['id'] . "<br>";
        echo "username: " . $row['username'] . "<br>";
        echo "password: " . $row['password'] . "<br>";
        echo "email: " . $row['email'] . "<br>";
        echo "privileges: " . $row['privileges'] . "<br>";
        echo "is_banned: " . $row['is_banned'] . "<br>";
        echo "is_archived: " . $row['is_archived'] . "<br>";
    }
    $database_connection -> close();
?>    
</body>
</html>
