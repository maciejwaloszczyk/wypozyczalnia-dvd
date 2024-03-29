<?php
    session_start();
    include('../php/creds.php');
    if(isset($_SESSION['user'])==false)
    {
        header("Location: /wypozyczalnia-dvd/index.php");
    }
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
        <link rel="icon" type="image/x-icon" href="../assets/favicon.png" />
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
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"></span><span> </span></div>
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
                                <div class="d-flex justify-content-between align-items-center experience"><span>Usuń Profil:</span><form action="/wypozyczalnia-dvd/pages/deleteAccount.php"><button class="btn btn-danger profile-button" type="submit">Usuń</button></form></div><br>
                            </div>
                        </div>
                    </div>
                    <!-- drugi level -->
                    <?php 
                     $resultHistory = $database_connection -> query("SELECT videos.* FROM videos, rental_data WHERE videos.id = rental_data.id_film AND rental_data.id_user = $idUser;")->fetch_all(MYSQLI_ASSOC);
                     ?>
                    <div class="row">
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Twoja Historia Wypożyczeń</h4>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php 
                        ?><div class="row gx-4 gx-lg-5"><?php
                            for($i=0;$i<count($resultHistory);$i++)
                            {
                                if($i%1==0&&$i!=0)
                                {
                                    ?></div><br><div class="row"><?php
                                }
                                ?>

                                    <a class="link-dark :focus" href="moviePage.php?id=<?=$resultHistory[$i]["id"]?>"><li class="d-flex justify-content-center list-group-item"><?=$resultHistory[$i]["title"] ?></li></a>
                                <?php
                            }
                        ?></div>
                    </ul>

                </div>
            </div>

            <!-- DRUGIE -->
            <div class="container col-3 p-1 h-100" style="height: 100%">
                <div class="navbar navbar-expand-lg navbar-dark bg-info d-flex flex-lg-column">
                    <div class="col-md-5 mb-2 w-50 p-4">
                        <p class="fs-4 text-light">Aktualnie Wypożyczone</p>
                    </div>
                    <!-- skrypt PHP -->
                    <?php
                    $resultVideos = $database_connection -> query("SELECT videos.* FROM videos, rental_data WHERE videos.id = rental_data.id_film AND rental_data.id_user = $idUser AND rental_data.isReturned = 0");

                    function resultToArray($result) {
                        $rows = array();
                        while($row = $result->fetch_assoc()) {
                            $rows[] = $row;
                        }
                        return $rows;
                    }                    
                    $readVideos = resultToArray($resultVideos);
                    foreach ($readVideos as $index=>$value)
                    {
                        $idOfEntity = $readVideos[$index]['id'];
                        $title = $readVideos[$index]['title'];
                        $photoDirectory = $readVideos[$index]['photoDirectory'];
                        ?>
                        <div class='col-md-5 mb-2 w-50'>
                                <div class='card h-100'>
                                    <div class='card-body'>        
                                        <?php
                                        $resultOverdue = $database_connection -> query("SELECT videos.* FROM videos, rental_data WHERE videos.id = rental_data.id_film AND rental_data.id_film = $idOfEntity AND rental_data.id_user = $idUser AND rental_data.isReturned = 0 AND date_of_return < CURDATE()")->fetch_assoc();
                                        if($resultOverdue!=NULL){?>
                                            <strong class='d-flex justify-content-center text-danger' style="color:red;">PO TERMINIE!</strong><?php
                                        }?>
                                    </div>
                                    <div class='card-subtitle' href='#!'><img class='mx-auto d-block col-md-6 mb-1' src='<?=$photoDirectory?>' alt='...' /></a>
                                        <h2 class='d-flex card-footer justify-content-center'><?=$title?></h2>
                                    </div>
                                </div>
                        </div>
                    <?php } ?>

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
