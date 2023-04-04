<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container px-5">
                <img class="col-2" src="/wypozyczalnia-dvd/assets/logo_transparent.png" alt="..." />
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/wypozyczalnia-dvd/index.php">Strona główna</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Najnowsze</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Kontakt</a></li>
                        <li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/pages/about.php">O nas</a></li>
                        <?php if(isset($_SESSION["user"]))
                        {
                            ?><li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/pages/profile.php">Profil</a></li><?php
                            if($_SESSION["privileges"]=="ADMIN")
                            {
                                ?><li><a href="/wypozyczalnia-dvd/pages/adminBoard.php" class="btn btn-danger" role="button">Panel administratora</a></li><?php
                            }
                            ?><li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/php/userLogout.php">⯇ Wyloguj</a></li><?php
                        } 
                        else
                        {
                            ?><li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/pages/login.php?bref=<?= $_SERVER['PHP_SELF'] ?>">Zaloguj</a></li>
                            <li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/pages/register.php?bref=<?= $_SERVER['PHP_SELF'] ?>">Zarejestruj</a></li><?php
                        }
                        ?>
                        
                    </ul>
                </div>
            </div>
        </nav>
