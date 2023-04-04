<?php include '../php/creds.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
</head>
<body>
    <?php
    session_start();
    if($_SESSION["privileges"]!="ADMIN")
    {
        header("Location: /wypozyczalnia-dvd/index.php");
    }
    ?>
    <form action="" method="POST">
        <input type="text" name="name" id="name" placeholder="Nazwa filmu"><br>
        <label for="genre">Gatunek</label>
        <select id="genre" name="genre">
            <option value="scfi">scfi</option>
            <option value="fantasy">fantasy</option>
            <option value="drama">drama</option>
            <option value="romance">romance</option>
            <option value="documentary">documentary</option>
            <option value="thriller">thriller</option>
            <option value="comedy">comedy</option>
            <option value="horror">horror</option>
            <option value="action">action</option>
            <option value="crime">crime</option>
            <option value="family">family</option>
        </select><br>
        <input type="number" name="year" id="year" min="1900" max="10000" step="1" placeholder="Year of release"><br>
        <input type="text" name="director" id="director" placeholder="Director"><br>
        <textarea name="desc" id="desc" cols="30" rows="10"></textarea><br>
        <input type="text" name="photodir" id="photodir" placeholder="Photo directory">
        <input type="submit" value="Dodaj" name="Dodaj">
    </form>
    <p><a href="adminBoard.php">Wróć do panelu administratora</a></p>
    <?php
    if(isset($_POST["Dodaj"]))
    {
        $cdate=date("Y-m-d");
        $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $conn->query("INSERT INTO `videos` (`id`, `title`, `genre`, `releaseYear`, `director`, `photoDirectory`, `description`, `dateAdded`) VALUES (NULL, '{$_POST["name"]}', '{$_POST["genre"]}', '{$_POST["year"]}-1-1', '{$_POST["director"]}', '{$_POST["photodir"]}', '{$_POST["desc"]}', '$cdate') ");
        $conn->close();
    }
    ?>
</body>
</html>