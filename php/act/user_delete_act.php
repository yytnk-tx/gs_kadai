<?php
  require_once('../common/funcs.php');

  $userId = $_POST['userId'];

  $pdo = db_conn();

  $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = :userId");

  $stmt->bindValue(':userId', $userId, PDO::PARAM_STR); 
  $status = $stmt->execute();

  if($status === false){
    sql_error($stmt);
  } else {
    redirect('http://localhost/gs_code/gs_kadai09/php/view/user_list.php');
  }
?>
