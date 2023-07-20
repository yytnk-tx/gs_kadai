<?php
    session_start();
    require_once('./model.php');
    loginCheck();

    $flash = getFlashMessage();
    $original = getOriginalMessage();

    $userName = $_SESSION['userName'];
    $roleName = $_SESSION['roleName'];
    $navView = getNavigationMenu('SalesManagement', 'ReportRegist');

    require_once('./templates/report_regist.php');