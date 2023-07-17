<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日報管理くん</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper-form d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <h3>ユーザ登録</h3>
                    <form action="http://localhost/gs_code/gs_kadai10/acts/user_regist_act.php" method="post">
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
                                required="true"  value="<?= isset($original['password']) ? $original['password'] : null; ?>">
                        </div>
                        <?php if(!empty($flash['password'])) : ?>
                            <div class="mb-3 text-danger">
                                <?= $flash['password'] ?>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="userRole" class="form-label">役割</label>
                            <div class="mb-3">
                            <select class="form-select" name="userRole" id="userRole" required>
                                <?= $roleSelectView ?>  
                            </select>
                        </div>
                        <?php if(!empty($flash['userRole'])) : ?>
                            <div class="mb-3 text-danger">
                                <?= $flash['userRole'] ?>
                            </div>
                        <?php endif; ?>
                        <?php if(isSystemAdministrator()) : ?>
                            <div class="mb-3">
                                <label for="userTenant" class="form-label">所属テナント</label>
                                <select class="form-select" name="userTenant" id="userTenant" required>
                                    <?= $tenantSelectView ?>  
                                </select>
                                <?php if(!empty($flash['userTenant'])) : ?>
                                    <div class="mb-3 text-danger">
                                        <?= $flash['userTenant'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="userTenant" id="userTenant" value=<?= $_SESSION['tenantId'] ?>>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">ユーザ作成</button>
                            <a href="http://localhost/gs_code/gs_kadai10/menu.php" class="btn btn-secondary">キャンセル</a>
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