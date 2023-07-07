<?php
  require_once('../common/funcs.php');

  session_start();

  $userName = $_POST['userName'];
  $password = $_POST['password'];

  $pdo = db_conn();

  $stmt = $pdo->prepare("SELECT count(*) as count FROM users WHERE user_name = :userName AND password = :password");

  $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);

  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  } else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result['count'] === 1) {
      $stmt = $pdo->prepare("SELECT user_id, user_name, role, user_tenant FROM users WHERE user_name = :userName AND password = :password");

      $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);

      $status = $stmt->execute();

      if($status === false){
        $error = $stmt->errorInfo();
        exit('ErrorMessage:'.$error[2]);
      } else {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['userId'] = $result['user_id'];
        $_SESSION['userName'] = $result['user_name'];
        $_SESSION['tenantId'] = $result['user_tenant'];
        $_SESSION['role'] = $result['role'];

        redirect('http://localhost/gs_code/gs_kadai09/php/view/land.php');
      }
    } else {
      redirect('http://localhost/gs_code/gs_kadai09/index.html');
    }
  }
?>
