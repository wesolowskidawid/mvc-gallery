<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel='stylesheet' href='/public/css/header.css'>
    <link type='text/css' rel='stylesheet' href='/public/css/upload/main.css'>
    <title>Upload file</title>
</head>

<body>
    <?php include_once __DIR__ . '/../header.view.php'; ?>
    <h2 id="pagetitle">Upload file</h2>
    <form action="/public/upload/process" method="post" enctype="multipart/form-data" id="upform">
        <label class="inputfile">
            <input type="file" name="fileToUpload" id="fileToUpload">
            Upload File
        </label><br>
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title" required><br>
        <label for="author">Author</label><br>
        <?php if (isset($_SESSION['user_id'])): ?>
        <input type="text" name="author" id="author" value="<?= $data['username'] ?>" required><br>
        <?php else: ?>
        <input type="text" name="author" id="author" required><br>
        <?php endif; ?>
        <label for="watermark">Watermark</label><br>
        <input type="text" name="watermark" id="watermark" required><br>
        <?php if (isset($_SESSION['user_id'])): ?>
        <label>
            <input type="radio" name="visibility" value=1 id="public" checked>Public
        </label>
        <br>
        <label>
            <input type="radio" name="visibility" value=0 id="private">Private
        </label>
        <br>
        <?php endif; ?>
        <input type="submit" value="Upload file" name="submit" id="submitupload">
    </form>
</body>

</html>