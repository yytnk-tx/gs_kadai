<?php
    session_start();
    require_once('./model.php');
    loginCheck();

    $flash = getFlashMessage();
    $original = getOriginalMessage();

    require_once('./templates/report_regist.php');