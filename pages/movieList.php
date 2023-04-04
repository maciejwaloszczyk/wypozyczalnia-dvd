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
    $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
    $res=$conn->query("SELECT * FROM videos")->fetch_all(MYSQLI_ASSOC);
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
                                    <th><span>Miniaturka</span></th>
                                    <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <form action="" method="POST">
                                    <td></td>
                                    <td><input type="text" name="name" id="name" placeholder="Nazwa filmu"></td>

                                    <td><select id="genre" name="genre">
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
                                    <td><input type="number" name="year" id="year" min="1900" max="10000" step="1" placeholder="Year of release" required></td>
                                    <td><input type="text" name="director" id="director" placeholder="Director" required></td>
                                    <td><textarea name="desc" id="desc" cols="30" rows="1" placeholder="opis" required></textarea></td>
                                    <td><input type="text" name="photodir" id="photodir" placeholder="Photo directory" required></td>
                                    <td><input type="submit" value="Dodaj" class="btn btn-success" name="Dodaj"></td>
                                </form>
                                <?php
                                if(isset($_POST["Dodaj"]))
                                {
                                    $cdate=date("Y-m-d");
                                    $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
                                    $conn->query("INSERT INTO `videos` (`id`, `title`, `genre`, `releaseYear`, `director`, `photoDirectiory`, `description`, `dateAdded`) VALUES (NULL, '{$_POST["name"]}', '{$_POST["genre"]}', '{$_POST["year"]}-1-1', '{$_POST["director"]}', '{$_POST["photodir"]}', '{$_POST["desc"]}', '$cdate') ");
                                    $conn->close();
                                    unset($_POST["Dodaj"]);
                                    Header('Location: '.$_SERVER['PHP_SELF']);
                                }
                                ?>
                            </table>
                            <table class="table user-list table-striped">
                                <thead>
                                    <tr>
                                    <th><span>ID</span></th>
                                    <th><span>Tytuł</span></th>
                                    <th class="text-center"><span>Rodzaj</span></th>
                                    <th><span>Data wydania</span></th>
                                    <th><span>Reżyser</span></th>
                                    <th><span>Miniaturka</span></th>
                                    <th><span>Opis</span></th>
                                    <th><span>Data dodania</span></th>
                                    <th>&nbsp;</th>
                                    </tr>
                                </thead>

                                <?php
                                foreach($res as $part){
                                ?>
                                <tr>
                                    <td><?=$part["id"]?></td>
                                    <td><?=$part["title"]?></td>
                                    <td><?=$part["genre"]?></td>
                                    <td><?=$part["releaseYear"]?></td>
                                    <td><?=$part["director"]?></td>
                                    <td><img class="mx-auto d-block col-md-11 mb-5" src="<?php echo $part["photoDirectory"];?>" alt="..." /></a></td>
                                    <td><textarea readonly rows="1" placeholder="opis" required><?=$part["description"]?></textarea></td>
                                    <td><?=$part["dateAdded"]?></td>
                                    <td><a href="editMovie.php?id='<?=$part["id"]?>'" class="btn btn-primary" role="button">Edit</a></td>
                                    <td><a href="deleteMovie.php?id='<?=$part["id"]?>'" class="btn btn-danger" role="button">Delete</a></td>
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