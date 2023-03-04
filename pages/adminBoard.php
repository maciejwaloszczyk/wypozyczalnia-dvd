<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Board</title>
</head>
<body>
    <?php
session_start();
    if($_SESSION["privileges"]!="ADMIN")
    {
        header("Location: /wypozyczalnia-dvd/index.php");
    }
    ?>
    <h2>Opcje</h2>
    <ul>
        <li><a href="movieList.php">Lista Filmów</a></li>
        <li><a href="userList.php">Lista Użytkowników</a></li>
        <li><a href="addMovie.php">Dodaj Film</a></li>
        <li><a href="deleteMovie.php">Usuń Konkretny Film</a></li>
        <li><a href="editMovie.php">Zmien Konkretny Film</a></li>
        <li><a href="overdue.php">Użytkownicy z Zaległościami</a></li>
    </ul>
</body>
</html>