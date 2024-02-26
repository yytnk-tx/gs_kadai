<?php
    require_once('funcs.php');

    session_start();

    // var_dump($_SESSION['userName']);
    // var_dump($_SESSION['tenantId']);
    // var_dump($_SESSION['role']);

    try {
        $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
      } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
      }
      
      $stmt = $pdo->prepare("SELECT role_id, role_name FROM roles");
      
      $status = $stmt->execute();
      
      if($status === false){
        $error = $stmt->errorInfo();
        exit('ErrorMessage:'.$error[2]);
      } else {
        $selectView = "";

        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            // var_dump($result);
            $selectView .= "<option value=" . h($result['role_id']) . ">";
            $selectView .= h($result['role_name']);
            $selectView .= "</option>";
        }
      }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー管理くん</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form action="./regist.php" method="post">
                    <div class="mb-3">
                        <label for="userName" class="form-label">UserName</label>
                        <input type="text" class="form-control" name="userName" id="userName" min="0" max="50"
                            required="true" autofocus="true">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" min="0" max="20"
                            required="true">
                    </div>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">UserRole</label>
                        <div class="mb-3">
                        <select class="form-select" name="userRole" id="userRole" required>
                            <!-- <option hidden>--選択--</option> -->
                            <?= $selectView ?>  
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userTenant" class="form-label">UserTenant</label>
                        <input type="text" class="form-control" name="userTenant" id="userTenant" min="0" max="7"
                            required="true">
                    </div>
                    <button type="submit" class="btn btn-primary">ユーザ作成</button>
                </form>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>