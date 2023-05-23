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
    <body>
        <!-- Responsive navbar-->
        <?php include "../php/header.php" ?>
        <!-- Page Content-->
        <div class="d-flex">
            <div class="container px-4 py-4 px-lg-10 d-flex align-content-md-center">
                <form action="../pages/passwordRenew.php" method="POST">
                    <div class="mb-3">
                        <label for="InputPassword1" class="form-label">Wpisz nowe hasło:</label>
                        <input type="password" class="form-control" id="InputPassword1" name="InputPassword1" required>
                        <label for="InputPassword2" class="form-label">Powtórz hasło:</label>
                        <input type="password" class="form-control" id="InputPassword2" name="InputPassword2" required>
                        <input type="hidden" name="activation_code" value="<?php echo $_GET['a'];?>">
                    </div>
                        <script>
                            var password = document.getElementById("InputPassword1"), confirm_password = document.getElementById("InputPassword2");

                            function validatePassword()
                            {
                                if(password.value != confirm_password.value)
                                {
                                    confirm_password.setCustomValidity("Hasła nie są takie same!");
                                }
                                else
                                {
                                    confirm_password.setCustomValidity('');
                                }
                            }

                            password.onchange = validatePassword;
                            confirm_password.onkeyup = validatePassword;
                        </script>
                    <button type="submit" class="btn btn-theme">Zapisz nowe hasło</button>
                    </div>
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