<?php
    session_start();
    require_once('./model.php');

    loginCheck();
    unsetTmpSession();

    $userName = $_SESSION['userName'];
    $roleName = $_SESSION['roleName'];
    $navView = getNavigationMenu('Dashboard', 'Dashboard');

    require_once('./templates/menu.php');