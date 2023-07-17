<?php
    session_start();
    require_once('./model.php');
    loginCheck();

    $flash = getFlashMessage();
    $original = getOriginalMessage();

    $tenantId = !empty($_POST['tenantId']) ? $_POST['tenantId'] : (!empty($original['tenantId']) ? $original['tenantId'] : "");
    $userId = !empty($_POST['userId']) ? $_POST['userId'] : (!empty($original['userId']) ? $original['userId'] : "");
    $date = !empty($_POST['date']) ? $_POST['date'] : (!empty($original['date']) ? $original['date'] : "");
    $report = !empty($_POST['report']) ? unescape_nl($_POST['report']) : (!empty($original['report']) ? $original['report'] : "");

    require_once('./templates/report_update.php');