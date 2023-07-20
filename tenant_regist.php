<?php
    session_start();
    require_once('./model.php');
    
    loginCheck();

    if(!isSystemAdministrator()) {
        exit('PERMISSION ERROR');
    }

    $flash = getFlashMessage();
    $original = getOriginalMessage();

    $userName = $_SESSION['userName'];
    $roleName = $_SESSION['roleName'];
    $navView = getNavigationMenu('TenantManagement', 'TenantRegist');

    require_once('./templates/tenant_regist.php');