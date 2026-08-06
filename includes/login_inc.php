<?php
session_start();
require('conn_1dt.php');

if (isset($_POST['login_btn'])) {
    $email = trim($_POST['email'] ?? '');
    $pwd   = $_POST['pwd'] ?? '';

    if ($email === '' || $pwd === '') {
        header('Location: ../login.php?error=empty_fields');
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM monitors WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $monitor = $stmt->fetch();

    // password_verify checks the submitted password against the hash
    // stored in the database — the plain password is never stored or compared directly.
    if ($monitor && password_verify($pwd, $monitor['password'])) {
        $_SESSION['id']        = $monitor['id'];
        $_SESSION['firstname'] = $monitor['firstname'];
        $_SESSION['lastname']  = $monitor['lastname'];
        header('Location: ../control_panel.php');
        exit;
    }

    header('Location: ../login.php?error=invalid_credentials');
    exit;
}

header('Location: ../login.php');
exit;
