<?php
    session_start();
    require_once('../model.php');

    // POSTメッセージの取得
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $validationFlg = false;

    // バリデーションチェック（ユーザ名）
    if(empty($userName)) {
        $_SESSION['flash']['userName'] = 'Username must not be blank.';
        $validationFlg = true;
    } else if(mb_strlen($userName) > 50) {
        $_SESSION['flash']['userName'] = 'Requested username is invalid. Please specify within 50 characters.';
        $validationFlg = true;
    } else {
        $_SESSION['original']['userName'] = $userName;
    }

    // バリデーションチェック（パスワード）
    if(empty($password)) {
        $_SESSION['flash']['password'] = 'Password must not be blank.';
        $validationFlg = true;
    } else if(mb_strlen($password) > 50) {
        $_SESSION['flash']['password'] = 'Requested password is invalid. Please specify within 50 characters.';
        $validationFlg = true;
    } else {
        $_SESSION['original']['password'] = $password;
    }

    // バリデーションNG時のリダイレクト
    if($validationFlg) {
        redirect('http://localhost/gs_code/gs_kadai10/index.php');
    }

    // ログイン処理
    $pdo = db_conn();

    $stmt = $pdo->prepare("SELECT users.user_id, users.user_name, users.password,
        users.role, roles.role_name, users.user_tenant, tenants.tenant_name FROM users
        JOIN roles ON users.role = roles.role_id JOIN tenants ON users.user_tenant = tenants.tenant_id
        WHERE user_name = :userName");
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
        $_SESSION['tenantName'] = $result['tenant_name'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['roleName'] = $result['role_name'];

        redirect('http://localhost/gs_code/gs_kadai10/menu.php');
    } else {
        $_SESSION['flash']['error'] = 'Requested username or password is invalid';

        redirect('http://localhost/gs_code/gs_kadai10/index.php');
    }

    exit();
