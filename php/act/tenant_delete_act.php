<?php
  require_once('../common/funcs.php');

  $tenantId = $_POST['tenantId'];

  $pdo = db_conn();

  $stmt = $pdo->prepare("DELETE FROM tenants WHERE tenant_id = :tenantId");

  $stmt->bindValue(':tenantId', $tenantId, PDO::PARAM_STR); 
  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  } else {
    redirect('http://localhost/gs_code/gs_kadai09/php/view/tenant_list.php');
  }
?>
