<?php
    session_start();
    require_once('./model.php');

    loginCheck();
    unsetTmpSession();

    require_once('./templates/menu.php');