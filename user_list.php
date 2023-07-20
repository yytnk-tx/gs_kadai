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
  
    $userName = $_SESSION['userName'];
    $roleName = $_SESSION['roleName'];
    $navView = getNavigationMenu('UserManagement', 'UserList');

    require_once('./templates/user_list.php');
