<?php
  require_once('../common/funcs.php');

  $userName = $_POST['userName'];
  $password = $_POST['password'];
  $userRole = $_POST['userRole'];
  $userTenant = $_POST['userTenant'];

  $pdo = db_conn();

  $stmt = $pdo->prepare("INSERT INTO users(user_id, user_name, password, role, user_tenant) VALUES
      (NULL, :userName, :password, :userRole, :userTenant)");

  $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $stmt->bindValue(':userRole', $userRole, PDO::PARAM_STR);
  $stmt->bindValue(':userTenant', $userTenant, PDO::PARAM_STR);

  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  }else{
    redirect('http://localhost/gs_code/gs_kadai09/php/view/user_list.php');
  }
?>
