<?php
    require_once('../common/funcs.php');
    session_start();
  
    $pdo = db_conn();
  
    $stmt = $pdo->prepare("SELECT users.user_id, users.user_name, roles.role_name, tenant_name FROM users 
        JOIN roles ON users.role = roles.role_id
        JOIN tenants ON users.user_tenant = tenants.tenant_id");
  
    $status = $stmt->execute();
  
    if($status === false){
      sql_error($stmt);
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日報管理くん</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper-list d-flex align-items-top">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                <h3>ユーザ一覧</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">UserName</th>
                            <th scope="col">Role</th>
                            <th scope="col">Tenant</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . h($result['user_name']) . "</td>";
                            echo "<td>" . h($result['role_name']) . "</td>";
                            echo "<td>" . h($result['tenant_name']) . "</td>";

                            echo "<td><form action='http://localhost/gs_code/gs_kadai09/php/view/user_update.php' method='post'>";
                            echo "<input type='hidden' name='userId' id='userId' value=" . h($result['user_id']) . ">";
                            echo "<input type='hidden' name='roleName' id='roleName' value=" . h($result['role_name']) . ">";
                            echo "<input type='hidden' name='userName' id='userName' value=" . h($result['user_name']) . ">";
                            echo "<input type='hidden' name='tenantName' id='tenantName' value=" . h($result['tenant_name']) . ">";
                            echo "<button type='submit' class='btn btn-warning'>更新</button>";
                            echo "</form></td>";

                            echo "<td><form action='http://localhost/gs_code/gs_kadai09/php/act/user_delete_act.php' method='post'>";
                            echo "<input type='hidden' name='userId' id='userId' value=" . h($result['user_id']) . ">";
                            echo "<button type='submit' class='btn btn-danger'>削除</button>";
                            echo "</form></td>";
                            $i++;
                        }
                    ?>
                    </tbody>
                    </table>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>