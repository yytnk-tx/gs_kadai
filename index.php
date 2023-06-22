<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>

    </header>

    <main>
        <form action="./php/confirm.php" method="post">

            <h1>プロジェクト情報</h1>

            <div class="container">
                <table class="responsive-table">
                    <thead class="responsive-table__head">
                        <tr class="responsive-table__row">
                            <th>項目</th>
                            <th>登録情報</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="project">プロジェクト</label></td>
                            <td><input type="text" name="project" id="project" required></td>
                        </tr>
                        <tr>
                            <td><label for="member">メンバー</label></td>
                            <td><input type="text" name="member" id="member" required></td>
                        </tr>
                        <tr>
                            <td><label for="date">日付</label></td>
                            <td><input type="month" name="date" id="date" required></td>
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
                        <td><input type="number" step="0.1" min=0 value=0 name="outlineDesign" id="outlineDesign" class="numberForm" required></td>
                    </tr>
                    <tr>
                        <td><label for="externalDesign">基本設計（外部）</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="externalDesign" id="externalDesign" required></td>
                    </tr>
                    <tr>
                        <td><label for="internalDesign">基本設計（内部）</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="internalDesign" id="internalDesign" required></td>
                    </tr>
                    <tr>
                        <td><label for="detailDesign">詳細設計</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="detailDesign" id="detailDesign" required></td>
                    </tr>
                    <tr>
                        <td><label for="programing">製造</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="programing" id="programing" required></td>
                    </tr>
                    <tr>
                        <td><label for="unitTest">単体テスト</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="unitTest" id="unitTest" required></td>
                    </tr>
                    <tr>
                        <td><label for="internalIntegrationTest">内部連結テスト</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="internalIntegrationTest" id="internalIntegrationTest" required></td>
                    </tr>
                    <tr>
                        <td><label for="externalIntegrationTest">外部連結テスト</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="externalIntegrationTest" id="externalIntegrationTest" required></td>
                    </tr>
                    <tr>
                        <td><label for="systemTest">総合テスト</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="systemTest" id="systemTest" required></td>
                    </tr>
                    <tr>
                        <td><label for="uat">UAT</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="uat" id="uat" required></td>
                    </tr>
                    <tr>
                        <td><label for="release">リリース</label></td>
                        <td><input type="number" step="0.1" min=0 value=0 name="release" id="release" required></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit">確認</button>
            <button type="button">クリア</button>
        </form>
    </main>

    <footer>

    </footer>
</body>

</html>