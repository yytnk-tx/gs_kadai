<?php
    session_start();
    require_once('../common/funcs.php');
    loginCheck();

    $flash = getFlashMessage();

    $tenantId = $_SESSION['tenantId'];
    $role = $_SESSION['role'];
  
    $pdo = db_conn();
  
    $stmt;

    if(isSystemAdministrator()) {
        $stmt = $pdo->prepare("SELECT
            tenants.tenant_id, tenants.tenant_name, 
            users.user_id, users.user_name,
            daily_reports.date, daily_reports.report_content AS report
            FROM daily_reports
            JOIN tenants ON daily_reports.tenant_id = tenants.tenant_id
            JOIN users ON daily_reports.user_id = users.user_id");
    } else {
        $stmt = $pdo->prepare("SELECT
            tenants.tenant_id, tenants.tenant_name, 
            users.user_id, users.user_name,
            daily_reports.date, daily_reports.report_content AS report
            FROM daily_reports
            JOIN tenants ON daily_reports.tenant_id = tenants.tenant_id
            JOIN users ON daily_reports.user_id = users.user_id
            WHERE daily_reports.tenant_id = :tenantId");
        $stmt->bindValue(':tenantId', $tenantId, PDO::PARAM_STR);
    }
    
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
                <h3>日報一覧</h3>
                <?php if(!empty($flash['error'])) : ?>
                    <div class="mb-3 text-danger">
                        <?= $flash['error'] ?>
                    </div>
                <?php endif; ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">TenantName</th>
                            <th scope="col">UserName</th>
                            <th scope="col">Date</th>
                            <th scope="col">Report</th>
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
                            echo "<td>" . h($result['tenant_name']) . "</td>";
                            echo "<td>" . h($result['user_name']) . "</td>";
                            echo "<td>" . h($result['date']) . "</td>";
                            echo "<td>" . substr(h($result['report']), 0, 10) . "</td>";

                            echo "<td><form action='http://localhost/gs_code/gs_kadai09_2/php/view/report_update.php' method='post'>";
                            echo "<input type='hidden' name='tenantId' id='tenantId' value=" . h($result['tenant_id']) . ">";
                            echo "<input type='hidden' name='userId' id='userId' value=" . h($result['user_id']) . ">";
                            echo "<input type='hidden' name='date' id='date' value=" . h($result['date']) . ">";
                            echo "<input type='hidden' name='report' id='report' value=" . h($result['report']) . ">";
                            echo "<button type='submit' class='btn btn-warning'>更新</button>";
                            echo "</form></td>";

                            echo "<td><form action='http://localhost/gs_code/gs_kadai09_2/php/act/report_delete_act.php' method='post'>";
                            echo "<input type='hidden' name='tenantId' id='tenantId' value=" . h($result['tenant_id']) . ">";
                            echo "<input type='hidden' name='userId' id='userId' value=" . h($result['user_id']) . ">";
                            echo "<input type='hidden' name='date' id='date' value=" . h($result['date']) . ">";
                            echo "<button type='submit' class='btn btn-danger'>削除</button>";
                            echo "</form></td>";
                            $i++;
                        }
                    ?>
                    </tbody>
                    </table>
                    <div class="d-flex justify-content-around">
                        <a href="http://localhost/gs_code/gs_kadai09_2/php/view/report_regist.php" class="btn btn-primary">日報を登録する</a>
                        <a href="http://localhost/gs_code/gs_kadai09_2/php/view/menu.php" class="btn btn-secondary">メニューに戻る</a>
                    </div>
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