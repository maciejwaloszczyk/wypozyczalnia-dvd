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
                <form action="../php/userLogin.php" method="POST">
                    <div class="mb-3">
                        <label for="InputEmail1" class="form-label">Adres e-mail</label>
                        <input type="email" class="form-control" id="InputEmail1" name="InputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Nie udostępniamy nikomu twojego adresu e-mail, chyba, że Chińczycy zapytają...</div>
                    </div>
                    <div class="mb-3">
                        <label for="InputPassword1" class="form-label">Hasło</label>
                        <input type="password" class="form-control" id="InputPassword1" name="InputPassword1">
                    </div>
                    <?php if (isset($_GET['userLoginError'])) echo '<div class="mb-3"><div id="userLoginError" class="form-text text-danger">Błędna nazwa użytkownika lub hasło</div></div>';
                    if (isset($_GET['userLoginBanned'])) echo '<div class="mb-3"><div id="userLoginError" class="form-text text-danger">Użytkownik zbanowany</div></div>'; ?>
                    <div class="mb-3">
                        <div id="emailHelp" class="form-text"><a href="#!">Zapomniałeś hasła?</a></div>
                        <div id="emailHelp" class="form-text"><a href="#!">Nie masz jeszcze konta?</a></div>
                    </div>
                    <input type="hidden" id="bref" name="bref" value="<?php echo $_GET['bref'];?>">
                    <button type="submit" class="btn btn-theme">Zaloguj się</button>
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
