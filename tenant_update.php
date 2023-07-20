<?php
    session_start();
    require_once('./model.php');

    loginCheck();

    if(!isSystemAdministrator()) {
        exit('PERMISSION ERROR');
    }

    $flash = getFlashMessage();
    $original = getOriginalMessage();

    $tenantId = !empty($_POST['tenantId']) ? $_POST['tenantId'] : (!empty($original['tenantId']) ? $original['tenantId'] : "");
    $tenantName = !empty($_POST['tenantName']) ? $_POST['tenantName'] : (!empty($original['tenantName']) ? $original['tenantName'] : "");

    $userName = $_SESSION['userName'];
    $roleName = $_SESSION['roleName'];
    $navView = getNavigationMenu('TenantManagement', 'TenantUpdate');

    require_once('./templates/tenant_update.php');
