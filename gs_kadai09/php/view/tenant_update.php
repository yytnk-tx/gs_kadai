<?php
    require_once('../common/funcs.php');
    session_start();

    $tenantId = $_POST['tenantId'];
    $tenantName = $_POST['tenantName'];
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
                    <h3>テナント更新</h3>
                    <form action="http://localhost/gs_code/gs_kadai09/php/act/tenant_update_act.php" method="post">
                        <div class="mb-3">
                            <label for="tenantId" class="form-label">TenantID</label>
                            <input type="text" class="form-control" name="tenantId" id="tenantId" minlength="7" maxlength="7"
                                required="true" readonly="readonly" value=<?= $tenantId ?>>
                            <label for="tenantName" class="form-label">TenantName</label>
                            <input type="text" class="form-control" name="tenantName" id="tenantName" minlength="0" maxlength="50"
                                required="true" autofocus="true" value=<?= $tenantName ?>>
                        </div>
                        <button type="submit" class="btn btn-primary">テナント更新</button>
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