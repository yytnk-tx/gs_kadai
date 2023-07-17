<?php
    session_start();
    require_once('../model.php');

    // POSTメッセージの取得
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $validationFlg = false;

    // バリデーションチェック（ユーザ名）
    if(empty($userName)) {
        $_SESSION['flash']['userName'] = 'ユーザ名は必須項目です。';
        $validationFlg = true;
    } else if(mb_strlen($userName) > 50) {
        $_SESSION['flash']['userName'] = 'ユーザ名の入力内容が不正です。';
        $validationFlg = true;
    } else {
        $_SESSION['original']['userName'] = $userName;
    }

    // バリデーションチェック（パスワード）
    if(empty($password)) {
        $_SESSION['flash']['password'] = 'パスワードは必須項目です。';
        $validationFlg = true;
    } else if(mb_strlen($password) > 50) {
        $_SESSION['flash']['password'] = 'パスワードの入力内容が不正です。';
        $validationFlg = true;
    } else {
        $_SESSION['original']['password'] = $password;
    }

    // バリデーションNG時のリダイレクト
    if($validationFlg) {
        redirect('http://localhost/gs_code/gs_kadai10/login.php');
    }

    // ログイン処理
    $pdo = db_conn();

    $stmt = $pdo->prepare("SELECT user_id, user_name, password, role, user_tenant FROM users WHERE user_name = :userName");
    $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
    $status = $stmt->execute();

    if($status === false){
        sql_error($stmt);
    }

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(password_verify($password, $result['password'])){
        $_SESSION['chk_ssid'] = session_id();
        $_SESSION['userId'] = $result['user_id'];
        $_SESSION['userName'] = $result['user_name'];
        $_SESSION['tenantId'] = $result['user_tenant'];
        $_SESSION['role'] = $result['role'];

        redirect('http://localhost/gs_code/gs_kadai10/menu.php');
    } else {
        $_SESSION['flash']['error'] = 'ユーザ名またはパスワードの内容が誤っています。';

        redirect('http://localhost/gs_code/gs_kadai10/login.php');
    }

    exit();
