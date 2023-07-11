<?php
  session_start();
  require_once('../common/funcs.php');
  loginCheck();

  $report = $_POST['report'];
  $tenantId = $_POST['tenantId'];
  $userId = $_POST['userId'];
  $date = $_POST['date'];

  $validationFlg = false;

  // バリデーションチェック（テナントID）
  // DB上への存在チェックもしたい
  if(empty($tenantId)) {
      $_SESSION['flash']['error'] = '不正な更新操作が行われました。';
      $validationFlg = true;
  } else {
      $_SESSION['original']['tenantId'] = $tenantId;
  }

  // バリデーションチェック（ユーザID）
  // DB上への存在チェックもしたい
  if(empty($userId)) {
      $_SESSION['flash']['error'] = '不正な更新操作が行われました。';
      $validationFlg = true;
  } else {
      $_SESSION['original']['userId'] = $userId;
  }

  // バリデーションチェック（日付）
  if(empty($date)) {
      $_SESSION['flash']['error'] = '不正な更新操作が行われました。';
      $validationFlg = true;
  } else {
      $_SESSION['original']['date'] = $date;
  }

  // バリデーションチェック（日報）
  if(empty($report)) {
      $_SESSION['flash']['report'] = '日報は必須項目です。';
      $validationFlg = true;
  } else {
      $_SESSION['original']['report'] = $report;
  }

  // バリデーションNG時のリダイレクト
  if($validationFlg) {
      redirect('http://localhost/gs_code/gs_kadai09_2/php/view/report_update.php');
  }

  $pdo = db_conn();

  $stmt = $pdo->prepare("UPDATE daily_reports SET report_content = :report
    WHERE tenant_id = :tenantId AND user_id = :userId AND date = :date");

  $stmt->bindValue(':report', $report, PDO::PARAM_STR);
  $stmt->bindValue(':tenantId', $tenantId, PDO::PARAM_STR);
  $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
  $stmt->bindValue(':date', $date, PDO::PARAM_STR);

  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  }else{
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/report_list.php');
  }
?>
