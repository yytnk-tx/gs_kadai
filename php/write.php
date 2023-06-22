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

    $data = $project . "," . $member . "," . $date . "," . 
        $outlineDesign . "," . $externalDesign . "," . $internalDesign . "," . 
        $detailDesign . "," . $programing . "," . $unitTest . "," . 
        $internalIntegrationTest . "," . $externalIntegrationTest . "," . 
        $systemTest . "," . $uat . "," . $release . "\n";

    file_put_contents('../data/data.txt', $data, FILE_APPEND);
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
    <main>
        <h1>正常に登録が完了しました</h1>

        <ul>
            <li><a href="read.php">確認する</a></li>
            <li><a href="../index.php">戻る</a></li>
        </ul>
    </main>
</body>

</html>