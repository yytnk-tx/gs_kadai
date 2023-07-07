<?php
    require_once('../common/funcs.php');
    session_start();

    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    $roleName = $_POST['roleName'];
    $tenantName = $_POST['tenantName'];

    $pdo = db_conn();
      
    $stmt = $pdo->prepare("SELECT roles.role_id, roles.role_name 
        FROM role_grant_privileges INNER JOIN roles ON role_grant_privileges.role_grant_privilege = roles.role_id
        WHERE role_grant_privileges.role = :roleId;");

    $stmt->bindValue(':roleId', $_SESSION['role'], PDO::PARAM_STR);
    
    $status = $stmt->execute();
    
    if($status === false){
        sql_error($stmt);
    } else {
        $roleSelectView = "";

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($roleName === $result['role_name']) {
                $roleSelectView .= "<option selected value=" . h($result['role_id']) . ">";
            } else {
                $roleSelectView .= "<option value=" . h($result['role_id']) . ">";
            }
            $roleSelectView .= h($result['role_name']);
            $roleSelectView .= "</option>";
        }
    }

    $stmt = $pdo->prepare("SELECT tenant_id, tenant_name FROM tenants");

    $status = $stmt->execute();
    
    if($status === false){
        sql_error($stmt);
    } else {
        $tenantSelectView = "";

        while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tenantSelectView .= "<option value=" . h($result['tenant_id']) . ">";
            $tenantSelectView .= h($result['tenant_name']);
            $tenantSelectView .= "</option>";
        }
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
    <div class="wrapper-form d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <form action="http://localhost/gs_code/gs_kadai09/php/act/user_update_act.php" method="post">
                        <input type="hidden" class="form-control" name="userId" id="userId" required="true" value=<?= $userId ?>>
                        <div class="mb-3">
                            <label for="userName" class="form-label">UserName</label>
                            <input type="text" class="form-control" name="userName" id="userName" minlength="0" maxlength="50"
                                required="true" autofocus="true" value=<?= $userName ?>>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" minlength="0" maxlength="20"
                                required="true">
                        </div>
                        <div class="mb-3">
                            <label for="userRole" class="form-label">UserRole</label>
                            <div class="mb-3">
                            <select class="form-select" name="userRole" id="userRole" required>
                                <?= $roleSelectView ?>  
                            </select>
                        </div>
                        <?php if(isSystemAdministrator($_SESSION['role'])) : ?>
                            <div class="mb-3">
                                <label for="userTenant" class="form-label">UserTenant</label>
                                <select class="form-select" name="userTenant" id="userTenant" required>
                                    <?= $tenantSelectView ?>  
                                </select>
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="userTenant" id="userTenant" value=<?= $_SESSION['tenantId'] ?>>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary">ユーザ更新</button>
                    </form>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>