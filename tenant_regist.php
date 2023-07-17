<?php
    session_start();
    require_once('./model.php');
    
    loginCheck();

    if(!isSystemAdministrator()) {
        exit('PERMISSION ERROR');
    }

    $flash = getFlashMessage();
    $original = getOriginalMessage();

    require_once('./templates/tenant_regist.php');