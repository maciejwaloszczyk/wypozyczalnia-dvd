<?php include '../php/creds.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmy zaległe</title>
</head>
<body>
<?php
session_start();
    if($_SESSION["privileges"]!="ADMIN")
    {
        header("Location: /wypozyczalnia-dvd/index.php");
    }
    $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);//SELECT * FROM `rental_data` INNER JOIN users ON users.id=id_user WHERE isReturned=0 AND date_of_return<CURRENT_DATE; 
    $res=$conn->query("SELECT * FROM `rental_data` INNER JOIN videos ON videos.id=id_film WHERE isReturned=0 AND date_of_return<CURRENT_DATE AND id_user={$_GET["id"]}; ")->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    ?>
    <p><a href="overdue.php">Wróć do listy użytkowników z Zaległościami</a></p>
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
            </tr>
            <?php
            foreach($res as $part){
            ?>
            <tr>
                <td><?=$part["id_film"]?></td>
                <td><?=$part["title"]?></td>
                <td><?=$part["genre"]?></td>
                <td><?=$part["releaseYear"]?></td>
                <td><?=$part["director"]?></td>
                <td><?=$part["photoDirectory"]?></td>
                <td><?=$part["description"]?></td>
                <td><?=$part["dateAdded"]?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>