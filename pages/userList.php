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

    <!-- Responsive navbar-->
    <?php include "../php/header_profile.php" ?>
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
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table user-list table-striped">
                                <thead>
                                    <tr>
                                    <th><span>ID</span></th>
                                    <th><span>Nazwa</span></th>
                                    <th class="text-center"><span>Hasło</span></th>
                                    <th><span>Email</span></th>
                                    <th><span>Uprawnienia</span></th>
                                    <th><span>Czy zbanowany</span></th>
                                    <th><span>Czy zarchiwizowany</span></th>
                                    <th>&nbsp;</th>
                                    </tr>
                                </thead>

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
                                    <td><a href="?id='<?=$part["id"]?>'" class="btn btn-danger" role="button">Ban</a></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer-->
    <footer class="py-5 bg-dark navbar mt-auto">
        <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">KNS Web Services &copy; Wypożyczalnia DVD 2023</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>  
</body>
</html>