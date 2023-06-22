<?php
    $project = $_POST['project'];
    $member = $_POST['member'];
    $date = $_POST['date'];

    $outlineDesign = $_POST['outlineDesign'];
    $externalDesign = $_POST['externalDesign'];
    $internalDesign = $_POST['internalDesign'];
    $detailDesign = $_POST['detailDesign'];
    $programing = $_POST['programing'];
    $unitTest = $_POST['unitTest'];
    $internalIntegrationTest = $_POST['internalIntegrationTest'];
    $externalIntegrationTest = $_POST['externalIntegrationTest'];
    $systemTest = $_POST['systemTest'];
    $uat = $_POST['uat'];
    $release = $_POST['release'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>

    </header>

    <main>
        <form action="./write.php" method="post">

            <h1>プロジェクト情報</h1>

            <div class="container">
                <table class="responsive-table">
                    <thead class="responsive-table__head">
                        <tr class="responsive-table__row">
                            <th class="responsive-table__head__title responsive-table__head__title--name">項目</th>
                            <th class="responsive-table__head__title responsive-table__head__title--status">登録情報</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="project">プロジェクト</label></td>
                            <td><input type="text" name="project" id="project" value=<?php echo $project ?> readonly="readonly" required></td>
                        </tr>
                        <tr>
                            <td><label for="member">メンバー</label></td>
                            <td><input type="text" name="member" id="member" value=<?php echo $member ?> readonly="readonly" required></td>
                        </tr>
                        <tr>
                            <td><label for="date">日付</label></td>
                            <td><input type="month" name="date" id="date" value=<?php echo $date ?> readonly="readonly" required></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <h1>工数情報</h1>
            <table>
                <thead>
                    <tr>
                        <th>工程</th>
                        <th>工数</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><label for="outlineDesign">概要設計</label></td>
                        <td><input type="number" name="outlineDesign" id="outlineDesign" value=<?php echo $outlineDesign ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="externalDesign">基本設計（外部）</label></td>
                        <td><input type="number" name="externalDesign" id="externalDesign" value=<?php echo $externalDesign ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="internalDesign">基本設計（内部）</label></td>
                        <td><input type="number" name="internalDesign" id="internalDesign" value=<?php echo $internalDesign ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="detailDesign">詳細設計</label></td>
                        <td><input type="number" name="detailDesign" id="detailDesign" value=<?php echo $detailDesign ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="programing">製造</label></td>
                        <td><input type="number" name="programing" id="programing" value=<?php echo $programing ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="unitTest">単体テスト</label></td>
                        <td><input type="number" name="unitTest" id="unitTest" value=<?php echo $unitTest ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="internalIntegrationTest">内部連結テスト</label></td>
                        <td><input type="number" name="internalIntegrationTest" id="internalIntegrationTest" value=<?php echo $internalIntegrationTest ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="externalIntegrationTest">外部連結テスト</label></td>
                        <td><input type="number" name="externalIntegrationTest" id="externalIntegrationTest" value=<?php echo $externalIntegrationTest ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="systemTest">総合テスト</label></td>
                        <td><input type="number" name="systemTest" id="systemTest" value=<?php echo $systemTest ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="uat">UAT</label></td>
                        <td><input type="number" name="uat" id="uat" value=<?php echo $uat ?> readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td><label for="release">リリース</label></td>
                        <td><input type="number" name="release" id="release" value=<?php echo $release ?> readonly="readonly"></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit">登録</button>
            <button type="button">キャンセル</button>
        </form>
    </main>

    <footer>

    </footer>
</body>

</html>