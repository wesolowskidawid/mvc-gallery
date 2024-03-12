<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel='stylesheet' href='/public/css/header.css'>
    <title>Register</title>
</head>

<body>
    <?php include_once __DIR__ . '/../header.view.php'; ?>
    <h1>Register</h1>
    <?php if (isset($data['error'])): ?>
    <p><?= $data['error'] ?></p>
    <?php endif; ?>
    <?php if (isset($data['success'])): ?>
    <p><?= $data['success'] ?></p>
    <?php endif; ?>
</body>

</html>