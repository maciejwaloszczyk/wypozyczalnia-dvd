<?php include "../php/creds.php" ?>
<?php 
$conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
$res=$conn->query("SELECT * FROM videos WHERE id={$_GET["id"]};")->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/styles_2.css" rel="stylesheet" />
    <title><?=$res["title"]?></title>
</head>
<body>
<?php include "../php/header.php" ?>
<h2><?=$res["title"]?></h2>
<?php if(isset($_SESSION["user"])){ ?>
    <a class="btn btn-primary btn-sm" onclick="req(<?=$res["id"] ?>)">Wypożycz</a>
<?php
    } ?>
<p><?=$res["releaseYear"]?></p>
<p><?=$res["director"]?></p>
<p><?=$res["genre"]?></p><br>
<img src="<?=$res["photoDirectory"]?>" alt="">
<p><?=$res["description"]?></p>
</body>
<script>
    function req(id)
    {
        if(confirm("Czy na pewno chcesz wypożyczyć ten film?"))
        {
            const xhr=new XMLHttpRequest();
            xhr.open("POST","../php/borrow.php",true);

            xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xhr.onreadystatechange=()=>{}
            xhr.send("id="+id);
        }
        
    }
</script>
</html>