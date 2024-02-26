<?php
    session_start();
    require_once('../common/funcs.php');

    $_SESSION = [];

    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    session_destroy();

    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/login.php');
    exit();
