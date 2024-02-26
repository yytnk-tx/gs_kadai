<?php
  function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');  
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
      exit('DB Connection Error:' . $e->getMessage());
    }
  }

  function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit('SQL Error:' . print_r($error, true));
  }

  function redirect($file_name) {
    header('Location: ' . $file_name );
    exit();
  }

  function isSystemAdministrator($role) {
    if($role === 1) {
      return true;
    }

    return false;
  }

  function isUserAdministrator($role) {
    if($role === 2) {
      return true;
    }
    
    return false;
  }

  function isGeneralUser($role) {
    if($role === 3) {
      return true;
    }
    
    return false;
  }

?>