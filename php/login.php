<?php

$userName = $_POST['userName'];
$password = $_POST['password'];

try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

$stmt = $pdo->prepare("SELECT count(*) as count FROM users WHERE user_name = :userName AND password = :password");

$stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

$status = $stmt->execute();

if($status === false){
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
} else {
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  // var_dump($result['count']);

  if($result['count'] === 1) {
    $stmt = $pdo->prepare("SELECT user_name, role, user_tenant FROM users WHERE user_name = :userName AND password = :password");

    $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);

    $status = $stmt->execute();

    if($status === false){
      $error = $stmt->errorInfo();
      exit('ErrorMessage:'.$error[2]);
    } else {
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      session_start();

      $_SESSION['userName'] = $result['user_name'];
      $_SESSION['tenantId'] = $result['user_tenant'];
      $_SESSION['role'] = $result['role'];

      header('Location: ./land.php');
    }
  } else {
    header('Location: ../index.html');
  }
}
?>
