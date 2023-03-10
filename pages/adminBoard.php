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
    header("Location: /wypozyczalnia-dvd/pages/userList.php");
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
                                <table class="table user-list">
                                    <thead>
                                        <tr>
                                        <th><span>User</span></th>
                                        <th><span>Created</span></th>
                                        <th class="text-center"><span>Status</span></th>
                                        <th><span>Email</span></th>
                                        <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="https://bootdey.com/img/Content/user_1.jpg" alt="">
                                                <a href="#" class="user-link">Full name 1</a>
                                                <span class="user-subhead">Member</span>
                                            </td>
                                            <td>2013/08/12</td>
                                            <td class="text-center">
                                                <span class="label label-default">pending</span>
                                            </td>
                                            <td>
                                                <a href="#">marlon@brando.com</a>
                                            </td>
                                            <td style="width: 20%;">
                                                <a href="#" class="table-link text-warning">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="table-link text-info">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="table-link danger">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="https://bootdey.com/img/Content/user_3.jpg" alt="">
                                                <a href="#" class="user-link">Full name 2</a>
                                                <span class="user-subhead">Admin</span>
                                            </td>
                                            <td>2013/08/12</td>
                                            <td class="text-center">
                                                <span class="label label-success">Active</span>
                                            </td>
                                            <td>
                                                <a href="#">marlon@brando.com</a>
                                            </td>
                                            <td style="width: 20%;">
                                                <a href="#" class="table-link  text-warning">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="table-link  text-info">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="table-link danger">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="https://bootdey.com/img/Content/user_2.jpg" alt="">
                                                <a href="#" class="user-link">Full name 3</a>
                                                <span class="user-subhead">Member</span>
                                            </td>
                                            <td>2013/08/12</td>
                                            <td class="text-center">
                                                <span class="label label-danger">inactive</span>
                                            </td>
                                            <td>
                                                <a href="#">marlon@brando.com</a>
                                            </td>
                                            <td style="width: 20%;">
                                                <a href="#" class="table-link  text-warning">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="table-link  text-info">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                                <a href="#" class="table-link danger">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
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