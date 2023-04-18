<?php
    session_start();
    unset($_SESSION["user"]);
    header("Location: {$_GET["bref"]}");
?>