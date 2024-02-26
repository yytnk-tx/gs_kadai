<?php
    session_start();
    require_once('../model.php');

    $_SESSION = [];

    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    session_destroy();

    redirect('http://localhost/gs_code/gs_kadai10/index.php');
    exit();
