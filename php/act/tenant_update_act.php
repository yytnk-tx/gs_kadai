<?php
  session_start();
  require_once('../common/funcs.php');
  loginCheck();

  if(!isSystemAdministrator()) {
    exit('PERMISSION ERROR');
  }

  $tenantId = $_POST['tenantId'];
  $tenantName = $_POST['tenantName'];

  // バリデーションチェック（テナントID）
  // DB上への存在チェックもしたい
  if(empty($tenantId)) {
    $_SESSION['flash']['error'] = '不正な更新操作が行われました。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['tenantId'] = $tenantId;
  }

  // バリデーションチェック（テナント名）
  if(empty($tenantName)) {
    $_SESSION['flash']['tenantName'] = 'テナント名は必須項目です。';
    $validationFlg = true;
  } else if(mb_strlen($userName) > 50) {
    $_SESSION['flash']['tenantName'] = 'テナント名の入力内容が不正です。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['tenantName'] = $tenantName;
  }

  // バリデーションNG時のリダイレクト
  if($validationFlg) {
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/tenant_update.php');
  }

  $pdo = db_conn();

  $stmt = $pdo->prepare("UPDATE tenants SET tenant_name = :tenantName WHERE tenant_id = :tenantId");

  $stmt->bindValue(':tenantId', $tenantId, PDO::PARAM_STR);
  $stmt->bindValue(':tenantName', $tenantName, PDO::PARAM_STR);

  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  }else{
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/tenant_list.php');
  }
?>
