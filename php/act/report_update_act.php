<?php
  require_once('../common/funcs.php');

  $report = $_POST['report'];
  $tenantId = $_POST['tenantId'];
  $userId = $_POST['userId'];
  $date = $_POST['date'];

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
    redirect('http://localhost/gs_code/gs_kadai09/php/view/report_list.php');
  }
?>
