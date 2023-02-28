<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
<?php
session_start();
    if($_SESSION["privileges"]!="ADMIN")
    {
        header("Location: /wypozyczalnia-dvd/index.php");
    }
    ?>
    <p><a href="adminBoard.php">Wróć do panelu administratora</a></p>
</body>
</html>