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
  
    require_once('./templates/tenant_list.php');
