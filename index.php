<?php include "php/creds.php"; ?>
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
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/styles_2.css" rel="stylesheet" />

    </head>
    <body>
        <!-- Responsive navbar-->
        <?php include "php/header.php" ?>
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="assets/lotr.jpg" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="assets/hp.jpg" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="assets/auta.jpg" class="d-block w-100" alt="...">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- <div class="col-lg-12">
                    <h1 class="font-weight-light">Business Name or Tagline</h1>
                    <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
                    <a class="btn btn-primary" href="#!">Call to Action!</a>
                </div> -->
            </div>
            <!-- Content Row-->


        

            <h1>Najnowsze filmy</h1>
            <?php
            session_start();
            $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
            $res=$conn->query("SELECT * FROM videos ORDER BY releaseYear DESC;")->fetch_all(MYSQLI_ASSOC);
            $conn->close();
            for($i=0;$i<9;$i++)
            {
                if($i%3==0)
                {
                    if($i!=0)
                    {
                        ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row gx-4 gx-lg-5">
                    <?php
                }
                ?>
                        <div class="col-md-4 mb-5">
                            <a class="link-dark :focus" href="pages/moviePage.php?id=<?=$res[$i]["id"]?>">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h2 class="card-title"><?=$res[$i]["title"]?></h2>
                                    <p class="card-text"><?=$res[$i]["genre"]?></p>
                                </div>
                                <?php
                                if(isset($_SESSION["user"])){
                                    $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
                                    $isLoaned=$conn->query("SELECT * FROM rental_data WHERE id_film={$res[$i]["id"]} and id_user={$_SESSION["user"]}")->fetch_assoc();
                                }
                                ?>
                                <div class="nav-link" href="pages/moviePage.php?id=<?=$res[$i]["id"]?>"><img class="mx-auto d-block col-md-11 mb-5" src="<?=$res[$i]["photoDirectory"]?>" alt="..." /></a></div>
                                <div class="card-footer text-center">
                                    <div class="card text-left">
                                        <a class="btn btn-light" href="pages/moviePage.php?id=<?=$res[$i]["id"]?>">Więcej informacji</a>                                        
                                    </div>
                                    <div class="card text-right BtnLoan<?=$res[$i]["id"]?>">
                                        <?php if(isset($_SESSION["user"])){ ?>
                                            <?php
                                                if($isLoaned == NULL)
                                                {?>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-theme btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $res[$i]['id']; ?>">
                                                    Wypożycz
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal<?php echo $res[$i]['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Czy na pewno chcesz wyporzyczyć ten film?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <p>Tytuł: <?=$res[$i]["title"]?></p>
                                                        <p>Gatunek: <?=$res[$i]["genre"]?></p>
                                                        <p>Reżyser: <?=$res[$i]["director"]?></p>
                                                        <p>Data Wydania: <?=$res[$i]["releaseYear"]?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="req(<?php echo $res[$i]['id']; ?>)">Wypożycz</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    
                                                    <?php
                                                }
                                                else
                                                {?>
                                                    <button class="btn btn-theme btn-sm" disabled>Wypożyczone</button><?php
                                                }
                                            ?>
                                        <?php
                                        }
                                        ?>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                <?php
            }
            ?>
            </div>

            <h1>Najpopularniejsze filmy</h1>
            <?php
            $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
            $res=$conn->query("SELECT videos.*,COUNT(videos.id) as num FROM rental_data JOIN videos ON videos.id=id_film GROUP BY id_film ORDER BY num DESC;")->fetch_all(MYSQLI_ASSOC);
            $conn->close();
            for($i=0;$i<count($res);$i++)
            {
                if($i%3==0)
                {
                    if($i!=0)
                    {
                        ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row gx-4 gx-lg-5">
                    <?php
                }
                ?>
                        <div class="col-md-4 mb-5">
                            <a class="link-dark :focus" href="pages/moviePage.php?id=<?=$res[$i]["id"]?>">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h2 class="card-title"><?=$res[$i]["title"]?></h2>
                                    <p class="card-text"><?=$res[$i]["genre"]?></p>
                                </div>
                                <?php
                                    if(isset($_SESSION["user"])){
                                        $conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
                                        $isLoaned=$conn->query("SELECT * FROM rental_data WHERE id_film={$res[$i]["id"]} and id_user={$_SESSION["user"]}")->fetch_assoc();
                                    }
                                ?>
                                <div class="nav-link" href="pages/moviePage.php?id=<?=$res[$i]["id"]?>"><img class="mx-auto d-block col-md-11 mb-5" src="<?=$res[$i]["photoDirectory"]?>" alt="..." /></a></div>
                                <div class="card-footer text-center">
                                    <div class="card text-left">
                                        <a class="btn btn-light" href="pages/moviePage.php?id=<?=$res[$i]["id"]?>">Więcej informacji</a>                                        
                                    </div>
                                    <div class="card text-right BtnLoan<?=$res[$i]["id"]?>">
                                        <?php if(isset($_SESSION["user"])){ ?>
                                            <?php
                                                if($isLoaned == NULL)
                                                {?>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-theme btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $res[$i]['id']; ?>">
                                                    Wypożycz
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal<?php echo $res[$i]['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Czy na pewno chcesz wyporzyczyć ten film?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <p>Tytuł: <?=$res[$i]["title"]?></p>
                                                        <p>Gatunek: <?=$res[$i]["genre"]?></p>
                                                        <p>Reżyser: <?=$res[$i]["director"]?></p>
                                                        <p>Data Wydania: <?=$res[$i]["releaseYear"]?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="req(<?php echo $res[$i]['id']; ?>)">Wypożycz</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    <?php
                                                }
                                                else
                                                {?>
                                                    <button class="btn btn-theme btn-sm" disabled>Wypożyczone</button><?php
                                                }
                                            ?>
                                        <?php
                                        }
                                        ?>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                <?php
            }
            ?>
            </div>
        </div>



        <!-- Footer-->
        <footer class="py-5 bg-dark ">
        <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">KNS Web Services &copy; Wypożyczalnia DVD 2023</p></div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
    <script>
    function req(id)
    {
            const xhr=new XMLHttpRequest();
            xhr.open("POST","php/borrow.php",true);

            xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xhr.onreadystatechange=()=>{}
            xhr.send("id="+id);
            //window.location.reload()
            //document.getElementById("BtnLoan"+id).innerHTML="<button class=\"btn btn-theme btn-sm\" disabled>Wypożyczone</button>";//Make to work with multiple
            for(part of document.getElementsByClassName("BtnLoan"+id))
            {
                part.innerHTML="<button class=\"btn btn-theme btn-sm\" disabled>Wypożyczone</button>";
            }
        
    }

    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
    })

</script>
</html>
