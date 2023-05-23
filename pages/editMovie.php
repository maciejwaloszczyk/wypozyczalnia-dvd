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
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png" />
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
    $res=["id"=>0,"title"=>"","genre"=>"scfi","releaseYear"=>0,"director"=>"","description"=>"","photoDirectory"=>""];
    if(isset($_GET["id"]))
    {
        $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $res=$conn->query("SELECT * FROM videos WHERE id={$_GET["id"]};")->fetch_assoc();
        $conn->close();
    }
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
                <div class="main-box no-header clearfix">
                    <div class="d-flex justify-content-center main-box-body clearfix">
                        <div class="table-responsive-xl">
                            <table class="table user-list">
                                <thead>
                                    <tr>
                                    <th><span>ID</span></th>
                                    <th><span>Tytuł</span></th>
                                    <th><span>Rodzaj</span></th>
                                    <th><span>Data wydania</span></th>
                                    <th><span>Reżyser</span></th>
                                    <th><span>Opis</span></th>
                                    <th><span>Miniaturka</span></th>
                                    <th><span>Data dodania</span></th>
                                    <th>&nbsp;</th>
                                    </tr>
                                </thead>

                                <form action="" method="POST">
                                    <td><input type="number" name="id" id="id" value="<?=$res["id"]?>" ></td>
                                    <td><input type="text" name="name" id="name" placeholder="Nazwa filmu" value="<?=$res["title"]?>"></td>
                                    <td><select id="genre" name="genre" value="<?=$res["genre"]?>">
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
                                    </select></td>
                                    <td><input type="number" name="year" id="year" min="1900" max="10000" step="1" placeholder="Year of release" value="<?=substr($res["releaseYear"],0,4)?>"></td>
                                    <td><input type="text" name="director" id="director" placeholder="Director" value="<?=$res["director"]?>"></td>
                                    <td><textarea name="desc" id="desc" cols="30" rows="10"><?=$res["description"]?></textarea></td>
                                    <td><input type="text" name="photodir" id="photodir" placeholder="Photo directory" value="<?=$res["photoDirectory"]?>"></td>
                                    <td><input type="submit" value="Zmień" class="btn btn-primary" name="Zmień"></td>
                                </form>
                                <?php 
                                if(isset($_POST["Zmień"]))
                                {
                                    $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
                                    $conn->query("UPDATE videos SET title='{$_POST["name"]}',genre='{$_POST["genre"]}', releaseYear='{$_POST["year"]}-1-1', director='{$_POST["director"]}', description='{$_POST["desc"]}', photoDirectory='{$_POST["photodir"]}' WHERE id={$_POST["id"]};");
                                    $conn->close();
                                    header("Location: editMovie.php?id={$_POST["id"]}");
                                }
                                ?>
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