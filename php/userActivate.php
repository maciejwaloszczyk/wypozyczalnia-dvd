<?php include 'creds.php'; ?>
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
<body style="background-image: linear-gradient(to right, rgba(115, 12, 211, 20) , rgba(146, 76, 214, 51))">
    <!-- Responsive navbar-->
    <?php include "../php/header.php" ?>
    <!-- Page Content-->
    <?php
        extract($_GET);
        $activation_code = $a;
    
        $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
        $ifExists = $database_connection -> query("SELECT id FROM users WHERE activation_code LIKE '$activation_code'");
        if (sizeof($ifExists -> fetch_assoc()) != NULL)
        {
            $result = $database_connection -> query("UPDATE users SET is_active = 1 WHERE activation_code LIKE '$activation_code'");
            $database_connection -> close();?>
                <div class="container px-4 py-4 px-lg-10 d-flex justify-content-center">
                    <div class="text-light fs-1" >Dziękujemy za rejestrację!</div></br>
                </div><br>
                </div><?php
        }/*
        if ($ifExists -> fetch_assoc()['num_rows'] == 0)
        {
            <div class="container px-4 py-4 px-lg-10 d-flex justify-content-center">
                <div class="text-light fs-1" >Wystąpił błąd...</div></br>
            </div><br>
        }*/
    ?>
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