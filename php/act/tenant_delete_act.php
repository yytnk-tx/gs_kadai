<?php
  session_start();
  require_once('../common/funcs.php');
  loginCheck();

  if(!isSystemAdministrator()) {
    exit('PERMISSION ERROR');
  }

  $tenantId = $_POST['tenantId'];

  $validationFlg = false;

  // バリデーションチェック（テナントID）
  // DB上への存在チェックもしたい
  if(empty($tenantId)) {
    $_SESSION['flash']['error'] = '不正な操作が行われました。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['tenantId'] = $tenantId;
  }

  // バリデーションNG時のリダイレクト
  if($validationFlg) {
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/tenant_list.php');
  }

  $pdo = db_conn();

  $stmt = $pdo->prepare("DELETE FROM tenants WHERE tenant_id = :tenantId");

  $stmt->bindValue(':tenantId', $tenantId, PDO::PARAM_STR); 
  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  } else {
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/tenant_list.php');
  }
?>
