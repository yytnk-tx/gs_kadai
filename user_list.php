<?php
    session_start();
    require_once('./model.php');
    loginCheck();

    if(!isSystemAdministrator() && !isUserAdministrator()) {
        exit('PERMISSION ERROR');
    }

    $flash = getFlashMessage();

    $tenantId = $_SESSION['tenantId'];
    $role = $_SESSION['role'];

    $pdo = db_conn();
    $view = get_all_users($pdo);
  
    require_once('./templates/user_list.php');
