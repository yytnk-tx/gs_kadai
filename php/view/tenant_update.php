<?php
    session_start();
    require_once('../common/funcs.php');
    loginCheck();

    if(!isSystemAdministrator()) {
        exit('PERMISSION ERROR');
    }

    $flash = getFlashMessage();
    $original = getOriginalMessage();

    $tenantId = !empty($_POST['tenantId']) ? $_POST['tenantId'] : (!empty($original['tenantId']) ? $original['tenantId'] : "");
    $tenantName = !empty($_POST['tenantName']) ? $_POST['tenantName'] : (!empty($original['tenantName']) ? $original['tenantName'] : "");
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
                    <form action="http://localhost/gs_code/gs_kadai09_2/php/act/tenant_update_act.php" method="post">
                        <div class="mb-3">
                            <?php if(!empty($flash['error'])) : ?>
                                <div class="mb-3 text-danger">
                                    <?= $flash['error'] ?>
                                </div>
                            <?php endif; ?>
                            <label for="tenantId" class="form-label">テナントID</label>
                            <input type="text" class="form-control" name="tenantId" id="tenantId" minlength="7" maxlength="7"
                                required="true" readonly="readonly" value=<?= $tenantId ?>>
                            <label for="tenantName" class="form-label">テナント名</label>
                            <input type="text" class="form-control" name="tenantName" id="tenantName" minlength="0" maxlength="50"
                                required="true" autofocus="true" value=<?= $tenantName ?>>
                            <?php if(!empty($flash['tenantName'])) : ?>
                                <div class="mb-3 text-danger">
                                    <?= $flash['tenantName'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">テナント更新</button>
                            <a href="http://localhost/gs_code/gs_kadai09_2/php/view/tenant_list.php" class="btn btn-secondary">キャンセル</a>
                        </div>
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