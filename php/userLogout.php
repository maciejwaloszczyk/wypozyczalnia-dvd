<?php
    session_start();
    unset($_SESSION["user"]);
    header("Location: /wypozyczalnia-dvd/index.php");
?>