<?php
    session_start();
    include('../php/creds.php');
    $idUser = $_SESSION['user'];
    $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
    $result = $database_connection -> query("SELECT * FROM users WHERE id = $idUser");
    $read = $result -> fetch_assoc();

    if (isset($_POST['option']))
    {
        if ($_POST['option']=='Edycja')
        {
            $isEditing = '';
            $buttonValue = 'Zapisz';
        }
        else if ($_POST['option']=='Zapisz')
        {
            $database_connection = new mysqli('localhost:3306', USER, PASSWD, DBNAME);
            $usernameNew = $_POST['UsernameInput1'];
            $emailNew = $_POST['EmailInput1'];
            $result = $database_connection -> query("UPDATE users SET username = '$usernameNew' , email = '$emailNew' WHERE id = $idUser");
            $isEditing = 'disabled';
            $buttonValue = 'Edycja';

            $result = $database_connection -> query("SELECT * FROM users WHERE id = $idUser");
            $read = $result -> fetch_assoc();
        }
    }
    else 
    {
        $_POST['option'] = '';
        $isEditing = "disabled";
        $buttonValue = 'Edycja';
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
    <body class="d-flex flex-column min-vh-100">
        <!-- Responsive navbar-->
        <?php include "../php/header.php"; ?>
        <!-- Page Content-->
        <div class="d-flex col-12">
            <!-- PIERWSZE -->
            <div class="d-flex justify-content-start col-9 p-1 h-100 " style="height: 100%">
                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">NAZWA</span><span> </span></div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Ustawienia profilu</h4>
                                </div>
                                <div class="row mt-2">
                                <form method="post">
                                    <div class="col-md-6"><label class="labels">Nazwa</label><input type="text" id="UsernameInput1" name="UsernameInput1" class="form-control" value="<?php echo $read['username'] ?>" <?php echo $isEditing ?>></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">E-mail</label><input type="text" id="EmailInput1" name="EmailInput1" class="form-control" value="<?php echo $read['email'] ?>" <?php echo $isEditing ?>></div>
                                </div>
                                <div class="mt-5 text-center">
                                        <input class="btn btn-primary profile-button" type="submit" name="option" value="<?php echo $buttonValue ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 py-5">
                                </br></br></br>
                                <div class="d-flex justify-content-between align-items-center experience"><span>Resetuj Hasło:</span><form action="/wypozyczalnia-dvd/pages/remindMe.php"><button type="submit" class="btn btn-outline-danger">Resetuj</button></form></div><br>
                                <div class="d-flex justify-content-between align-items-center experience"><span>Usuń Profil:</span><button class="btn btn-danger profile-button" type="button">Usuń</button></div><br>
                            </div>
                        </div>
                    </div>
                    <!-- drugi level -->
                    <div class="row">
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Twoja Historia Wypożyczeń</h4>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start h-50 w-100">
                        <div class="row">
                            <div class="card h-100 col">
                                <div class="card-body">        
                                </div>
                                <div class="card-subtitle" href="#!"><img class="mx-auto d-block col-md-8 mb-3" src="https://2.allegroimg.com/s1024/0c8dfc/e1ecbf9745b5a9f6b25d6a6a4722.png" alt="..." /></a>
                                    <h2 class="d-flex card-footer justify-content-center">TITLE</h2>
                                </div>  
                            </div>
                            <div class="card h-100 col">
                                <div class="card-body">        
                                </div>
                                <div class="card-subtitle" href="#!"><img class="mx-auto d-block col-md-8 mb-3" src="https://2.allegroimg.com/s1024/0c8dfc/e1ecbf9745b5a9f6b25d6a6a4722.png" alt="..." /></a>
                                    <h2 class="d-flex card-footer justify-content-center">TITLE</h2>
                                </div>  
                            </div>
                            <div class="card h-100 col">
                                <div class="card-body">        
                                </div>
                                <div class="card-subtitle" href="#!"><img class="mx-auto d-block col-md-8 mb-3" src="https://2.allegroimg.com/s1024/0c8dfc/e1ecbf9745b5a9f6b25d6a6a4722.png" alt="..." /></a>
                                    <h2 class="d-flex card-footer justify-content-center">TITLE</h2>
                                </div>  
                            </div>
                            <div class="card h-100 col">
                                <div class="card-body">        
                                </div>
                                <div class="card-subtitle" href="#!"><img class="mx-auto d-block col-md-8 mb-3" src="https://2.allegroimg.com/s1024/0c8dfc/e1ecbf9745b5a9f6b25d6a6a4722.png" alt="..." /></a>
                                    <h2 class="d-flex card-footer justify-content-center">TITLE</h2>
                                </div>  
                            </div>
                            <div class="card h-100 col">
                                <div class="card-body">        
                                </div>
                                <div class="card-subtitle" href="#!"><img class="mx-auto d-block col-md-8 mb-3" src="https://2.allegroimg.com/s1024/0c8dfc/e1ecbf9745b5a9f6b25d6a6a4722.png" alt="..." /></a>
                                    <h2 class="d-flex card-footer justify-content-center">TITLE</h2>
                                </div>  
                            </div>
                        </div>

                    </div>
                     
                </div>
            </div>
            <!-- DRUGIE -->
            <div class="d-flex justify-content-end col-3 p-1 h-100" style="height: 100%">
                <div class="navbar navbar-expand-lg navbar-dark bg-info col-12 h-100 d-flex flex-lg-column">
                    <div class="col-md-5 mb-2 w-50 p-4">
                        <p class="fs-4 text-light">Aktualnie Wypożyczone</p>
                    </div>
                    <div class="col-md-5 mb-2 w-50">
                            <div class="card h-100">
                                <div class="card-body">        
                                </div>
                                <div class="card-subtitle" href="#!"><img class="mx-auto d-block col-md-8 mb-3" src="https://2.allegroimg.com/s1024/0c8dfc/e1ecbf9745b5a9f6b25d6a6a4722.png" alt="..." /></a>
                                    <h2 class="d-flex card-footer justify-content-center">TITLE</h2>
                                </div>  
                            </div>
                    </div>
                    <div class="col-md-5 mb-2 w-50">
                            <div class="card h-100">
                                <div class="card-body">        
                                </div>
                                <div class="card-subtitle" href="#!"><img class="mx-auto d-block col-md-8 mb-3" src="https://2.allegroimg.com/s1024/0c8dfc/e1ecbf9745b5a9f6b25d6a6a4722.png" alt="..." /></a>
                                    <h2 class="d-flex card-footer justify-content-center">TITLE</h2>
                                </div>  
                            </div>
                    </div>
                    <div class="col-md-5 mb-2 w-50">
                            <div class="card h-100">
                                <div class="card-body">        
                                </div>
                                <div class="card-subtitle" href="#!"><img class="mx-auto d-block col-md-8 mb-3" src="https://2.allegroimg.com/s1024/0c8dfc/e1ecbf9745b5a9f6b25d6a6a4722.png" alt="..." /></a>
                                    <h2 class="d-flex card-footer justify-content-center">TITLE</h2>
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