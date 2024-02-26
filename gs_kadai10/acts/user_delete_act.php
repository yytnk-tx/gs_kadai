<?php
  session_start();
  require_once('../model.php');
  loginCheck();

  if(!isSystemAdministrator() && !isUserAdministrator()) {
    exit('PERMISSION ERROR');
  }

  $userId = $_POST['userId'];

  $validationFlg = false;

  // バリデーションチェック（ユーザID）
  // DB上への存在チェックもしたい
  if(empty($userId)) {
    $_SESSION['flash']['error'] = '不正な操作が行われました。';
    $validationFlg = true;
  }

  // バリデーションNG時のリダイレクト
  if($validationFlg) {
    redirect('http://localhost/gs_code/gs_kadai10/user_list.php');
  }

  $pdo = db_conn();

  $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = :userId");

  $stmt->bindValue(':userId', $userId, PDO::PARAM_STR); 
  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  } else {
    redirect('http://localhost/gs_code/gs_kadai10/user_list.php');
  }
?>
