<?php
  session_start();
  require_once('../common/funcs.php');
  loginCheck();

  $tenantId = $_POST['tenantId'];
  $userId = $_POST['userId'];
  $date = $_POST['date'];

  // バリデーションチェック（テナントID）
  // DB上への存在チェックもしたい
  if(empty($tenantId)) {
    $_SESSION['flash']['error'] = '不正な更新操作が行われました。';
    $validationFlg = true;
  }

  // バリデーションチェック（ユーザID）
  // DB上への存在チェックもしたい
  if(empty($userId)) {
    $_SESSION['flash']['error'] = '不正な更新操作が行われました。';
    $validationFlg = true;
  }

  // バリデーションチェック（日付）
  if(empty($date)) {
    $_SESSION['flash']['error'] = '不正な更新操作が行われました。';
    $validationFlg = true;
  }

  // バリデーションNG時のリダイレクト
  if($validationFlg) {
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/report_list.php');
  }

  $pdo = db_conn();

  $stmt = $pdo->prepare("DELETE FROM daily_reports
    WHERE tenant_id = :tenantId AND user_id = :userId AND date = :date");

  $stmt->bindValue(':tenantId', $tenantId, PDO::PARAM_STR);
  $stmt->bindValue(':userId', $userId, PDO::PARAM_STR); 
  $stmt->bindValue(':date', $date, PDO::PARAM_STR); 
  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  } else {
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/report_list.php');
  }
?>
