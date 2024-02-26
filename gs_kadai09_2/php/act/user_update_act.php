<?php
  session_start();
  require_once('../common/funcs.php');
  loginCheck();

  if(!isSystemAdministrator() && !isUserAdministrator()) {
    exit('PERMISSION ERROR');
  }

  $userId = $_POST['userId'];
  $userName = $_POST['userName'];
  $password = $_POST['password'];
  $userRole = $_POST['userRole'];
  $userTenant = $_POST['userTenant'];

  $validationFlg = false;

  // バリデーションチェック（ユーザID）
  // DB上への存在チェックもしたい
  if(empty($userId)) {
    $_SESSION['flash']['error'] = '不正な更新操作が行われました。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['userId'] = $userId;
  }

  // バリデーションチェック（ユーザ名）
  if(empty($userName)) {
    $_SESSION['flash']['userName'] = 'ユーザ名は必須項目です。';
    $validationFlg = true;
  } else if(mb_strlen($userName) > 50) {
    $_SESSION['flash']['userName'] = 'ユーザ名の入力内容が不正です。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['userName'] = $userName;
  }

  // バリデーションチェック（パスワード）
  if(empty($password)) {
    $_SESSION['flash']['password'] = 'パスワードは必須項目です。';
    $validationFlg = true;
  } else if(mb_strlen($password) > 50) {
    $_SESSION['flash']['password'] = 'パスワードの入力内容が不正です。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['password'] = $password;
  }

  // バリデーションチェック（役割）
  // DB上への存在チェックもしたい
  if(empty($userRole)) {
    $_SESSION['flash']['userRole'] = '役割は必須項目です。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['userRole'] = $userRole;
  }

  // バリデーションチェック（テナント）
  // DB上への存在チェックもしたい
  if(empty($userTenant)) {
    $_SESSION['flash']['userTenant'] = '役割は必須項目です。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['userTenant'] = $userTenant;
  }

  // バリデーションNG時のリダイレクト
  if($validationFlg) {
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/user_update.php');
  }

  $pdo = db_conn();

  $stmt = $pdo->prepare("UPDATE users SET user_name = :userName, password = :password, role = :userRole, user_tenant = :userTenant
    WHERE user_id = :userId");

  $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
  $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
  $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
  $stmt->bindValue(':userRole', $userRole, PDO::PARAM_STR);
  $stmt->bindValue(':userTenant', $userTenant, PDO::PARAM_STR);

  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  } else {
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/user_list.php');
  }
?>
