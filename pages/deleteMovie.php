<?php include '../php/creds.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Movie</title>
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
        <input type="number" name="id" id="id"><br>
        <input type="submit" name="Delete" value="Delete"><br>
        <input type="text" name="name" id="name" placeholder="Nazwa filmu">
        <input type="number" name="year" id="year" min="1900" max="10000" step="1" placeholder="Year of release">
        <input type="text" name="director" id="director" placeholder="Director">
    </form>
    <p><a href="adminBoard.php">Wróć do panelu administratora</a></p>
    <?php
    if(isset($_POST["Delete"]))
    {
        $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $conn->query("DELETE FROM videos WHERE id={$_POST["id"]}");//vulnerable to sql injection
        $conn->close();
    }
    ?>
</body>
</html>