<?php include "../php/creds.php" ?>
<?php
session_start();
$conn=new mysqli('localhost:3306', USER, PASSWD, DBNAME);
$res=$conn->query("SELECT * FROM videos WHERE id={$_GET["id"]};")->fetch_assoc();
if(isset($_SESSION["user"])){
    $isLoaned=$conn->query("SELECT * FROM rental_data WHERE id_film={$_GET["id"]} and id_user={$_SESSION["user"]}")->fetch_assoc();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/styles_2.css" rel="stylesheet" />
    <title><?=$res["title"]?></title>
</head>
<body>
    <?php include "../php/header.php" ?>
    <div class="container px-4 px-lg-5">
        <h1><?=$res["title"]?></h1>
        <div class="container">
            <div class="col">
                <h6><?=$res["releaseYear"]?></h6>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-start">
                <div class="container col">
                    <div class="row">
                        <img class="mx-auto col-md-8 mb-5" src="<?=$res["photoDirectory"]?>" alt="">
                    </div>
                    <div class="row my-4">
                    <?php if(isset($_SESSION["user"])){ ?>
                            <?php
                                if($isLoaned == NULL)
                                {?>
                                    <button class="btn btn-theme btn-sm" onclick="req(<?php echo $res['id']; ?>)">Wypożycz</button><?php
                                }
                                else
                                {?>
                                    <button class="btn btn-theme btn-sm" disabled>Wypożyczone</button><?php
                                }
                            ?>
                    <?php
                        } ?> 
                    </div>
                </div>
                <div class="col">
                    <h3>Reżyser: <?=$res["director"]?></h3>
                    <h3>Gatunek: <?=$res["genre"]?></h3>
                    <p><?=$res["description"]?></p>
                </div>
            </div>
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
            if(confirm("Czy na pewno chcesz wypożyczyć ten film?"))
            {
                const xhr=new XMLHttpRequest();
                xhr.open("POST","../php/borrow.php",true);

                xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                xhr.onreadystatechange=()=>{}
                xhr.send("id="+id);
            }
        }
    </script>
</html>