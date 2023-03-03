<?php include '../php/creds.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
</head>
<body>
<?php
session_start();
    if($_SESSION["privileges"]!="ADMIN")
    {
        header("Location: /wypozyczalnia-dvd/index.php");
    }
    $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
    $res=$conn->query("SELECT * FROM videos")->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    ?>
    <p><a href="adminBoard.php">Wróć do panelu administratora</a></p>
    <table>
        <tbody>
        <tr>
                <td>id</td>
                <td>title</td>
                <td>genre</td>
                <td>release year</td>
                <td>director</td>
                <td>Photo directory</td>
                <td>description</td>
                <td>date added</td>
                <td></td>
            </tr>
            <?php
            foreach($res as $part){
            ?>
            <tr>
                <td><?=$part["id"]?></td>
                <td><?=$part["title"]?></td>
                <td><?=$part["genre"]?></td>
                <td><?=$part["releaseYear"]?></td>
                <td><?=$part["director"]?></td>
                <td><?=$part["photoDirectiory"]?></td>
                <td><?=$part["description"]?></td>
                <td><?=$part["dateAdded"]?></td>
                <td><a href="deleteMovie.php?id='<?=$part["id"]?>'">Delete</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>