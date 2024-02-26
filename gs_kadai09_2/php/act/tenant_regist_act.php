<?php
  require_once('../common/funcs.php');
  session_start();
  loginCheck();

  if(!isSystemAdministrator()) {
    exit('PERMISSION ERROR');
  }

  $tenantId = $_POST['tenantId'];
  $tenantName = $_POST['tenantName'];

  $validationFlg = false;

  // バリデーションチェック（テナントID）
  if(empty($tenantId)) {
    $_SESSION['flash']['tenantId'] = 'ユーザIDは必須項目です。';
    $validationFlg = true;
  } else if(mb_strlen($tenantId) !== 7) {
    $_SESSION['flash']['tenantId'] = 'テナントIDの入力内容が不正です。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['tenantId'] = $tenantId;
  }

  // バリデーションチェック（テナント名）
  if(empty($tenantName)) {
    $_SESSION['flash']['tenantName'] = 'ユーザ名は必須項目です。';
    $validationFlg = true;
  } else if(mb_strlen($tenantName) > 50) {
    $_SESSION['flash']['tenantName'] = 'ユーザ名の入力内容が不正です。';
    $validationFlg = true;
  } else {
    $_SESSION['original']['tenantName'] = $tenantName;
  }

  // バリデーションNG時のリダイレクト
  if($validationFlg) {
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/tenant_regist.php');
  }

  // テナント登録処理
  $pdo = db_conn();

  $stmt = $pdo->prepare("INSERT INTO tenants(tenant_id, tenant_name) VALUES (:tenantId, :tenantName)");

  $stmt->bindValue(':tenantId', $tenantId, PDO::PARAM_STR);
  $stmt->bindValue(':tenantName', $tenantName, PDO::PARAM_STR);

  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  }else{
    redirect('http://localhost/gs_code/gs_kadai09_2/php/view/tenant_list.php');
  }
?>
