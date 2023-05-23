<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container px-5">
                <div class="row align-items-center">
                    <div class="col">
                        <a href="/wypozyczalnia-dvd/index.php"><img class="col-4" src="/wypozyczalnia-dvd/assets/logo_transparent.png" alt="..." /></a>
                    </div>
                    <div class="col-5" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/wypozyczalnia-dvd/index.php">Strona główna</a></li>
                            <li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/pages/list.php">Filmy</a></li>
                            <li class="nav-item"><a class="nav-link" href="#!">Kontakt</a></li>
                            <li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/pages/about.php">O nas</a></li>
                            <?php if(isset($_SESSION["user"]))
                            {
                                $brefadd="";
                                if(sizeof($_GET)!=0)
                                {
                                    $brefadd="?";
                                    foreach($_GET as $get_keys => $get_vals)
                                    {
                                        if($brefadd!="?")$brefadd.="&";
                                        $brefadd.=$get_keys."=".$get_vals;
                                    }
                                }
                                ?><li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/pages/profile.php">Profil</a></li><?php
                                if($_SESSION["privileges"]=="ADMIN")
                                {
                                    ?><li><a href="/wypozyczalnia-dvd/pages/adminBoard.php" class="btn btn-danger" role="button">Panel administratora</a></li><?php
                                }
                                ?><li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/php/userLogout.php?bref=<?= $_SERVER['PHP_SELF'].$brefadd ?>">⯇ Wyloguj</a></li><?php
                            } 
                            else
                            {
                                $brefadd="";
                                if(sizeof($_GET)!=0)
                                {
                                    $brefadd="?";
                                    foreach($_GET as $get_keys => $get_vals)
                                    {
                                        if($brefadd!="?")$brefadd.="&";
                                        $brefadd.=$get_keys."=".$get_vals;
                                    }
                                }
                                ?><li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/pages/login.php?bref=<?= $_SERVER['PHP_SELF'].$brefadd ?>">Zaloguj</a></li>
                                <li class="nav-item"><a class="nav-link" href="/wypozyczalnia-dvd/pages/register.php?bref=<?= $_SERVER['PHP_SELF'].$brefadd ?>">Zarejestruj</a></li><?php
                            }
                            ?>
                            
                        </ul>
                    </div>

                </div>
            </div>
        </nav>
