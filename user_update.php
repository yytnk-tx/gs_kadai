<?php
    session_start();
    require_once('./model.php');

    loginCheck();

    if(!isSystemAdministrator() && !isUserAdministrator()) {
        exit('PERMISSION ERROR');
    }
    
    $flash = getFlashMessage();
    $original = getOriginalMessage();

    $userId = !empty($_POST['userId']) ? $_POST['userId'] : (!empty($original['userId']) ? $original['userId'] : "");
    $updateUserName = !empty($_POST['userName']) ? $_POST['userName'] : (!empty($original['userName']) ? $original['userName'] : "");
    $roleId = !empty($_POST['roleId']) ? $_POST['roleId'] : (!empty($original['userRole']) ? $original['userRole'] : "");
    $tenantId = !empty($_POST['tenantId']) ? $_POST['tenantId'] : (!empty($original['userTenant']) ? $original['userTenant'] : "");

    $pdo = db_conn();
    $roleSelectView = get_role_list_at_user_regist($pdo);
    $tenantSelectView = get_tenant_list_at_user_regist($pdo);

    $userName = $_SESSION['userName'];
    $roleName = $_SESSION['roleName'];
    $navView = getNavigationMenu('UserManagement', 'UserUpdate');

    require_once('./templates/user_update.php');
