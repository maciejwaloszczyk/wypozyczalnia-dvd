<?php
include('../php/creds.php');
extract($_POST);
session_start();
if(isset($_SESSION['user'])==false)
{
    header("Location: /wypozyczalnia-dvd/index.php");
}
if (isset($_POST['Delete']))
{
    $idUser = $_SESSION['user'];
    $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
    $a=$database_connection->query("SELECT * FROM users WHERE id LIKE '$idUser' AND password LIKE '$InputPassword1' AND is_active = 1 AND is_archived = 0;")->fetch_all(MYSQLI_ASSOC);
    if(Count($a)!=0)
    {
        $b=$database_connection->query("SELECT * FROM rental_data WHERE id_user LIKE '$idUser' AND isReturned = 0")->fetch_all(MYSQLI_ASSOC);
        if(Count($b)==0)
        {
            if ($a[0]["is_banned"]==1)
            {
                header("Location: /wypozyczalnia-dvd/pages/login.php?bannedUser=true&bref=$bref");
            }
            {
                $result = $database_connection -> query("UPDATE users SET is_archived = 1 WHERE id = $idUser");
                $database_connection->close();
                session_destroy();
                header("Location: /wypozyczalnia-dvd/index.php");
            }            
        }
        else ?>
        <script>
            alert("Błąd systemu: Użytkownik nie oddał wszystkich płyt DVD!");
        </script>
        <?php

    }
    else header("Location: /wypozyczalnia-dvd/pages/deleteAccount.php?userLoginError=true");
}
?>
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
    <body>
        <!-- Responsive navbar-->
        <?php include "../php/header.php" ?>
        <!-- Page Content-->
        <div class="d-flex">
            <div class="container px-4 py-4 px-lg-10 d-flex align-content-md-center">
                <form method="POST">
                    <div class="mb-3">
                        <label for="InputEmail1" class="form-label">Usuwanie konta</label>
                        <div id="emailHelp" class="form-text">Podaj hasło</div>
                        <input type="password" class="form-control" id="InputPassword1" name="InputPassword1" aria-describedby="PasswordHelp" required>
                        <?php 
                            if (isset($_GET['userLoginError'])) echo '<div class="mb-3"><div id="userLoginError" class="form-text text-danger">Błędne hasło</div></div>';      
                        ?>
                        <div id="emailHelp" class="form-text text-danger">UWAGA! Usunięcie konta jest operacją bezpowrotną!</div>
                    </div>
                    <input type="submit" name="Delete" class="btn btn-danger" value="USUŃ">
                </form>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark navbar fixed-bottom">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">KNS Web Services &copy; Wypożyczalnia DVD 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>