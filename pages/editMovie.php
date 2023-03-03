<?php include '../php/creds.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    if($_SESSION["privileges"]!="ADMIN")
    {
        header("Location: /wypozyczalnia-dvd/index.php");
    }
    $res=[];
    if(isset($_GET["id"]))
    {
        $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $res=$conn->query("SELECT * FROM videos WHERE id={$_GET["id"]};")->fetch_assoc();
        $conn->close();
    }
    ?>
    <form action="" method="POST">
        <input type="number" name="id" id="id" value="<?=@$res["id"]?>" >
        <input type="text" name="name" id="name" placeholder="Nazwa filmu" value="<?=@$res["title"]?>"><br>
        <label for="genre">Gatunek</label>
        <select id="genre" name="genre" value="<?=@$res["genre"]?>">
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
        <input type="number" name="year" id="year" min="1900" max="10000" step="1" placeholder="Year of release" value="<?=@substr($res["releaseYear"],0,4)?>"><br>
        <input type="text" name="director" id="director" placeholder="Director" value="<?=@$res["director"]?>"><br>
        <textarea name="desc" id="desc" cols="30" rows="10"><?=@$res["description"]?></textarea><br>
        <input type="text" name="photodir" id="photodir" placeholder="Photo directory" value="<?=@$res["photoDirectiory"]?>">
        <input type="submit" value="Zmień" name="Zmień">
    </form>
    <p><a href="adminBoard.php">Wróć do panelu administratora</a></p>
    <?php 
    if(isset($_POST["Zmień"]))
    {
        $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $conn->query("UPDATE videos SET title='{$_POST["name"]}',genre='{$_POST["genre"]}', releaseYear='{$_POST["year"]}-1-1', director='{$_POST["director"]}', description='{$_POST["desc"]}', photoDirectiory='{$_POST["photodir"]}' WHERE id={$_POST["id"]};");
        $conn->close();
        header("Location: editMovie.php?id={$_POST["id"]}");
    }
    ?>
</body>
</html>