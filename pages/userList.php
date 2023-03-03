<?php include '../php/creds.php'; ?>
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
    if(isset($_GET["id"]))
    {
        $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $conn->query("UPDATE users SET is_banned=1 WHERE id={$_GET["id"]};");
        $conn->close();
    }
    $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
    $res=$conn->query("SELECT * FROM users")->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    ?>
    <p><a href="adminBoard.php">Wróć do panelu administratora</a></p>
    <table>
        <tbody>
        <tr>
                <td>id</td>
                <td>nazwa</td>
                <td>hasło</td>
                <td>email</td>
                <td>privileges</td>
                <td>is banned</td>
                <td>is archived</td>
                <td></td>
            </tr>
            <?php
            foreach($res as $part){
            ?>
            <tr>
                <td><?=$part["id"]?></td>
                <td><?=$part["username"]?></td>
                <td><?=$part["password"]?></td>
                <td><?=$part["email"]?></td>
                <td><?=$part["privileges"]?></td>
                <td><?=$part["is_banned"]?></td>
                <td><?=$part["is_archived"]?></td>
                <td><a href="?id='<?=$part["id"]?>'">Ban</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>