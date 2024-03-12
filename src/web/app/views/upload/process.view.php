<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel='stylesheet' href='/public/css/header.css'>
    <link type='text/css' rel='stylesheet' href='/public/css/upload/process.css'>
    <title>Upload file</title>
</head>

<body>
    <?php include_once __DIR__ . '/../header.view.php'; ?>
    <h2 id="pagetitle">Uploading a file</h2>
    <h3><?php
        if(isset($data['message']))
        {
            echo $data['message'];
        }
    ?></h3>
</body>

</html>