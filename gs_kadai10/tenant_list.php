<?php
    session_start();
    require_once('./model.php');

    loginCheck();

    if(!isSystemAdministrator()) {
        exit('PERMISSION ERROR');
    }

    $flash = getFlashMessage();
  
    $pdo = db_conn();
    $view = get_all_tenants($pdo);

    $userName = $_SESSION['userName'];
    $roleName = $_SESSION['roleName'];
    $navView = getNavigationMenu('TenantManagement', 'TenantList');
  
    require_once('./templates/tenant_list.php');
