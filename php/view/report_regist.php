<?php
    require_once('../common/funcs.php');
    session_start();
    loginCheck();

    $flash = getFlashMessage();
    $original = getOriginalMessage();
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
                    <h3>日報登録</h3>
                    <?php if(!empty($flash['error'])) : ?>
                        <div class="mb-3 text-danger">
                            <?= $flash['error'] ?>
                        </div>
                    <?php endif; ?>
                    <form action="http://localhost/gs_code/gs_kadai09_2/php/act/report_regist_act.php" method="post">
                        <div class="mb-3">
                            <label for="date" class="form-label">日付</label>
                            <input type="text" class="form-control" name="date" id="date" required="true" autofocus="true">
                            <?php if(!empty($flash['date'])) : ?>
                                <div class="mb-3 text-danger">
                                    <?= $flash['date'] ?>
                                </div>
                            <?php endif; ?>
                            <label for="report" class="form-label">日報</label>
                            <textarea class="form-control" rows="10" name="report" id="report" maxlength="600" required="true"></textarea>
                            <?php if(!empty($flash['report'])) : ?>
                                <div class="mb-3 text-danger">
                                    <?= $flash['report'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">日報登録</button>
                            <a href="http://localhost/gs_code/gs_kadai09_2/php/view/menu.php" class="btn btn-secondary">キャンセル</a>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('#date').datepicker({
            autoclose: true,
            defaultViewDate: Date(),
            format: 'yyyy/mm/dd',
            todayBtn: true,
            todayBtn: 'linked',
        });
    </script>
</body>
</html>