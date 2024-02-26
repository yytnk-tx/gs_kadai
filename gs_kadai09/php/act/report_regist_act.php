<?php
  require_once('../common/funcs.php');
  session_start();

  $tenantId = $_SESSION['tenantId'];
  $userId = $_SESSION['userId'];
  $date = $_POST['date'];
  $report = $_POST['report'];

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
    redirect('http://localhost/gs_code/gs_kadai09/php/view/report_list.php');
  }
?>
