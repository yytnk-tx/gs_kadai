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
                    <?= $view ?>
                    </tbody>
                    </table>
                    <div class="d-flex justify-content-around">
                        <a href="http://localhost/gs_code/gs_kadai10/report_regist.php" class="btn btn-primary">日報を登録する</a>
                        <a href="http://localhost/gs_code/gs_kadai10/menu.php" class="btn btn-secondary">メニューに戻る</a>
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