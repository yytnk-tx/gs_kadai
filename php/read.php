<?php
    $data = file_get_contents("../data/data.txt");
    $arr = explode("\n", $data);
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
        <table>
            <thead>
                <tr>
                    <th>プロジェクト</th>
                    <th>メンバー</th>
                    <th>日付</th>
                    <th>概要設計</th>
                    <th>基本設計（外部）</th>
                    <th>基本設計（内部）</th>
                    <th>詳細設計</th>
                    <th>製造</th>
                    <th>単体テスト</th>
                    <th>内部連結テスト</th>
                    <th>外部連結テスト</th>
                    <th>総合テスト</th>
                    <th>UAT</th>
                    <th>リリース</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($arr as $value) {
                        $elements = explode(",", $value);
                        echo "<tr>";
                        foreach($elements as $element) {
                            echo "<td>" . $element . "</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

        <a href="../index.php">戻る</a>
    </main>
</body>

</html>