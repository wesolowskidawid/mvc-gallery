<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel='stylesheet' href='/public/css/header.css'>
    <link type='text/css' rel='stylesheet' href='/public/css/loginregister/main.css'>
    <title>Login</title>
</head>

<body>
    <?php include_once __DIR__ . '/../header.view.php'; ?>
    <h2 id="pagetitle">Login</h2>
    <form action="/public/login/process" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($data['error'])): ?>
    <p><?= $data['error'] ?></p>
    <?php endif; ?>
</body>

</html>