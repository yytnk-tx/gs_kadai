<?php
  session_start();
  require_once('../common/funcs.php');
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
</head>

<body>
    <div class="wrapper-form d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <form action="http://localhost/gs_code/gs_kadai09_2/php/act/login_act.php" method="post">
                        <div class="mb-3">
                            <label for="userName" class="form-label">ユーザ名</label>
                            <input type="text" class="form-control" name="userName" id="userName" minlength="0" maxlength="50"
                                required="true" autofocus="true" value="<?= isset($original['userName']) ? $original['userName'] : null; ?>">
                        </div>
                        <?php if(!empty($flash['userName'])) : ?>
                            <div class="mb-3 text-danger">
                                <?= $flash['userName'] ?>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="password" class="form-label">パスワード</label>
                            <input type="password" class="form-control" name="password" id="password" minlength="0" maxlength="50"
                                required="true" value="<?= isset($original['password']) ? $original['password'] : null; ?>">
                        </div>
                        <?php if(!empty($flash['password'])) : ?>
                            <div class="mb-3 text-danger">
                                <?= $flash['password'] ?>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($flash['error'])) : ?>
                            <div class="mb-3 text-danger">
                                <?= $flash['error'] ?>
                            </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary">Login</button>
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