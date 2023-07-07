<?php
    require_once('../common/funcs.php');
    session_start();
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
    <div class="wrapper-land d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <?php if(isSystemAdministrator($_SESSION['role'])) : ?>
                        <div class="mb-3">
                            <h5>テナント管理</h5>
                            <a href="http://localhost/gs_code/gs_kadai09/php/view/tenant_regist.php" class="btn btn-light">新規登録</a>
                            <a href="http://localhost/gs_code/gs_kadai09/php/view/tenant_list.php" class="btn btn-light">一覧参照</a>
                        </div>
                    <?php endif; ?>

                    <?php if(isSystemAdministrator($_SESSION['role'])
                        || isUserAdministrator($_SESSION['role'])) : ?>
                        <div class="mb-3">
                            <h5>ユーザー管理</h5>
                            <a href="http://localhost/gs_code/gs_kadai09/php/view/user_regist.php" class="btn btn-light">新規登録</a>
                            <a href="http://localhost/gs_code/gs_kadai09/php/view/user_list.php" class="btn btn-light">一覧参照</a>
                        </div>
                    <?php endif; ?>

                    <?php if(isSystemAdministrator($_SESSION['role'])
                        || isUserAdministrator($_SESSION['role'])
                        || isGeneralUser($_SESSION['role'])) : ?>
                        <div class="mb-1">
                            <h5>日報管理</h5>
                            <a href="http://localhost/gs_code/gs_kadai09/php/view/report_regist.php" class="btn btn-light">新規登録</a>
                            <a href="http://localhost/gs_code/gs_kadai09/php/view/report_list.php" class="btn btn-light">一覧参照</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>