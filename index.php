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
            <!-- Call to Action-->
            <div class="my-5 py-4">
                <div class="card-body">
                    <div class="input-group">
                        <div class="form-outline">
                          <a class="list" href="pages/list.php">Wszystkie filmy</a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Content Row-->


        

        <p>Najnowsze filmy</p>
        <?php
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
                        <div class="card h-100">
                            <div class="card-body">
                                <h2 class="card-title"><?=$res[$i]["title"]?></h2>
                                <p class="card-text"><?=$res[$i]["genre"]?></p>
                            </div>
                            <div class="nav-link" href="#!"><img class="mx-auto d-block col-md-11 mb-5" src="<?=$res[$i]["photoDirectory"]?>" alt="..." /></a></div>
                            <div class="card-footer"><a class="btn btn-primary btn-sm" href="pages/moviePage.php?id=<?=$res[$i]["id"]?>">More Info</a>
                            <?php if(isset($_SESSION["user"])){ ?>
                                <a class="btn btn-primary btn-sm" onclick="req(<?=$res[$i]["id"] ?>)">Wypożycz</a>
                            <?php
                            }
                            ?>
                        </div>
                        </div>
                    </div>
            <?php
        }
        ?>

    <p>Najpopularniejsze filmy</p>
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
                        <div class="card h-100">
                            <div class="card-body">
                                <h2 class="card-title"><?=$res[$i]["title"]?></h2>
                                <p class="card-text"><?=$res[$i]["genre"]?></p>
                            </div>
                            <div class="nav-link" href="#!"><img class="mx-auto d-block col-md-11 mb-5" src="<?=$res[$i]["photoDirectory"]?>" alt="..." /></a></div>
                            <div class="card-footer"><a class="btn btn-primary btn-sm" href="pages/moviePage.php?id=<?=$res[$i]["id"]?>">More Info</a>
                            <?php if(isset($_SESSION["user"])){ ?>
                                <a class="btn btn-primary btn-sm" onclick="req(<?=$res[$i]["id"] ?>)">Wypożycz</a>
                            <?php
                            }
                            ?>
                        </div>
                        </div>
                    </div>
            <?php
        }//błąd domknięcia div
        ?>


            

            </div>

        </div>




        <!-- Footer-->
        <footer class="py-5 bg-dark">
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
        if(confirm("Czy na pewno chcesz wypożyczyć ten film?"))
        {
            const xhr=new XMLHttpRequest();
            xhr.open("POST","php/borrow.php",true);

            xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xhr.onreadystatechange=()=>{}
            xhr.send("id="+id);
        }
        
    }
</script>
</html>
