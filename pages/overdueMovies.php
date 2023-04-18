<?php include '../php/creds.php'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Wypożyczalnia DVD</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/styles_2.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
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

    <!-- Responsive navbar-->
    <?php include "../php/header.php" ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container px-5">
            <a class="navbar-brand" href="adminBoard.php">Panel Administratora</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="userList.php">Użytkownicy</a></li>
                    <li class="nav-item"><a class="nav-link" href="overdue.php">Zaległości</a></li>
                    <li class="nav-item"><a class="nav-link" href="movieList.php">Filmy</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content-->
    <div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-lg-12">
        <h6><a href="overdue.php">Wróć do listy użytkowników z Zaległościami</a></h6>
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list ">
                            <thead>
                                <tr>
                                <th><span></span></th>
                                <th><span>Tytuł</span></th>
                                <th><span>Rodzaj</span></th>
                                <th><span>Data wydania</span></th>
                                <th><span>Reżyser</span></th>
                                <th><span>Opis</span></th>
                                <th><span>Data terminowego oddania</span></th>
                                <th>&nbsp;</th>
                                </tr>
                            </thead>
            <?php
            foreach($res as $part){
            ?>
            <tr>
                <td><?=$part["id_film"]?></td>
                <td><?=$part["title"]?></td>
                <td><?=$part["genre"]?></td>
                <td><?=$part["releaseYear"]?></td>
                <td><?=$part["director"]?></td>
                <td><textarea readonly rows="1" placeholder="opis" required><?=$part["description"]?></textarea></td>
                <td><?=$part["date_of_return"]?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>