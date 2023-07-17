<?php
    session_start();
    require_once('./model.php');

    $flash = getFlashMessage();
    $original = getOriginalMessage();

    require_once('./templates/login.php');