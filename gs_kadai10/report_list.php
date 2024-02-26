<?php
    session_start();
    require_once('./model.php');

    loginCheck();

    $flash = getFlashMessage();

    $tenantId = $_SESSION['tenantId'];
    $role = $_SESSION['role'];
  
    $pdo = db_conn();
    $view = get_all_reports($pdo);

    $userName = $_SESSION['userName'];
    $roleName = $_SESSION['roleName'];
    $navView = getNavigationMenu('SalesManagement', 'ReportList');

    require_once('./templates/report_list.php');