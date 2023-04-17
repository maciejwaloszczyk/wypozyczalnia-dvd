<?php include "../php/creds.php" ?>
<?php 
session_start();
if(isset($_SESSION["user"]))
{
    $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
    $res=$conn->query("INSERT INTO rental_data VALUES (NULL,{$_SESSION["user"]},{$_POST["id"]},0,CURRENT_DATE+100);");
    $conn->close();
}

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
    <title>Document</title>
</head>
<body>
</body>
</html>