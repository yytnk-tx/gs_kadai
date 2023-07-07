<?php
  require_once('../common/funcs.php');

  $userId = $_POST['userId'];
  $userName = $_POST['userName'];
  $password = $_POST['password'];
  $userRole = $_POST['userRole'];
  $userTenant = $_POST['userTenant'];

  $pdo = db_conn();

  $stmt = $pdo->prepare("UPDATE users SET user_name = :userName, password = :password, role = :userRole, user_tenant = :userTenant
    WHERE user_id = :userId");

  $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
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
