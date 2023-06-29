<?php

$userName = $_POST['userName'];
$password = $_POST['password'];
$userRole = $_POST['userRole'];
$userTenant = $_POST['userTenant'];

try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

$stmt = $pdo->prepare("INSERT INTO users(user_id, user_name, password, role, user_tenant) VALUES
    (NULL, :userName, :password, :userRole, :userTenant)");

$stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':userRole', $userRole, PDO::PARAM_STR);
$stmt->bindValue(':userTenant', $userTenant, PDO::PARAM_STR);

$status = $stmt->execute();

if($status === false){
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
  header('Location: ../index.html');
}
?>
