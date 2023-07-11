<?php
    session_start();
    require_once('../common/funcs.php');
    loginCheck();

    $flash = getFlashMessage();
    $original = getOriginalMessage();

    $tenantId = !empty($_POST['tenantId']) ? $_POST['tenantId'] : (!empty($original['tenantId']) ? $original['tenantId'] : "");
    $userId = !empty($_POST['userId']) ? $_POST['userId'] : (!empty($original['userId']) ? $original['userId'] : "");
    $date = !empty($_POST['date']) ? $_POST['date'] : (!empty($original['date']) ? $original['date'] : "");
    $report = !empty($_POST['report']) ? $_POST['report'] : (!empty($original['report']) ? $original['report'] : "");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper-form d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <h3>日報更新</h3>
                    <?php if(!empty($flash['error'])) : ?>
                        <div class="mb-3 text-danger">
                            <?= $flash['error'] ?>
                        </div>
                    <?php endif; ?>
                    <form action="http://localhost/gs_code/gs_kadai09_2/php/act/report_update_act.php" method="post">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="tenantId" id="tenantId" value="<?= $tenantId ?>">
                            <input type="hidden" class="form-control" name="userId" id="userId" value="<?= $userId ?>">
                            <label for="date" class="form-label">Date</label>
                            <input type="text" class="form-control" name="date" id="date" value="<?= $date ?>" readonly="readonly">
                            <?php if(!empty($flash['date'])) : ?>
                                <div class="mb-3 text-danger">
                                    <?= $flash['date'] ?>
                                </div>
                            <?php endif; ?>
                            <label for="report" class="form-label">Report</label>
                            <textarea class="form-control" rows="10" name="report" id="report" maxlength="600" required="true" autofocus="true">
                                <?= $report ?>
                            </textarea>
                            <?php if(!empty($flash['report'])) : ?>
                                <div class="mb-3 text-danger">
                                    <?= $flash['report'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">日報登録</button>
                            <a href="http://localhost/gs_code/gs_kadai09_2/php/view/report_list.php" class="btn btn-secondary">キャンセル</a>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
</body>
</html>