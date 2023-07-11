<?php
  function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');  
  }

  function loginCheck() {
    if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] !== session_id()) {
        exit('LOGIN ERROR');
    } else {
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
  }

  function getFlashMessage() {
    $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : [];
    unset($_SESSION['flash']);

    return $flash;
  }

  function getOriginalMessage() {
    $original = isset($_SESSION['original']) ? $_SESSION['original'] : [];
    unset($_SESSION['original']);

    return $original;
  }

  function unsetTmpSession() {
    unset($_SESSION['flash']);
    unset($_SESSION['original']);
  }

  function db_conn() {
    try {
      $db_name = 'gs_db';
      $db_id   = 'root';
      $db_pw   = '';
      $db_host = 'localhost';
      $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);

      return $pdo;
    } catch (PDOException $e) {
      exit('DB Connection Error: ' . $e->getMessage());
    }
  }

  function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit('SQL Error: ' . print_r($error, true));
  }

  function redirect($file_name) {
    header('Location: ' . $file_name );
    exit();
  }

  function isSystemAdministrator() {
    if($_SESSION['role'] === 1) {
      return true;
    }
    return false;
  }

  function isUserAdministrator() {
    if($_SESSION['role'] === 2) {
      return true;
    }
    return false;
  }

  function isGeneralUser() {
    if($_SESSION['role'] === 3) {
      return true;
    }
    return false;
  }
?>