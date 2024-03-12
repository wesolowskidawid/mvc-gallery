<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel='stylesheet' href='/public/css/header.css'>
    <link type='text/css' rel='stylesheet' href='/public/css/loginregister/main.css'>
    <title>Register</title>
</head>

<body>
    <?php include_once __DIR__ . '/../header.view.php'; ?>
    <h2 id="pagetitle">Register</h2>
    <form action="/public/register/process" method="POST">
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" required>
        <br>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="password2">Repeat password</label>
        <input type="password" name="password2" id="password2" required>
        <br>
        <input type="submit" value="Register">
    </form>
</body>

</html>