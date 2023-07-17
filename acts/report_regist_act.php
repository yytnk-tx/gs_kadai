<?php
  session_start();
  require_once('../model.php');
  loginCheck();

  $tenantId = $_SESSION['tenantId'];
  $userId = $_SESSION['userId'];
  $date = $_POST['date'];
  $report = $_POST['report'];

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
    $_SESSION['flash']['date'] = '日付は必須項目です。';
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
    redirect('http://localhost/gs_code/gs_kadai10/report_regist.php');
  }

  $pdo = db_conn();

  $stmt = $pdo->prepare("INSERT INTO daily_reports(tenant_id, user_id, date, report_content)
    VALUES (:tenantId, :userId, :date, :report)");

  $stmt->bindValue(':tenantId', $tenantId, PDO::PARAM_STR);
  $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
  $stmt->bindValue(':date', $date, PDO::PARAM_STR);
  $stmt->bindValue(':report', $report, PDO::PARAM_STR);

  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  }else{
    redirect('http://localhost/gs_code/gs_kadai10/report_list.php');
  }
?>
