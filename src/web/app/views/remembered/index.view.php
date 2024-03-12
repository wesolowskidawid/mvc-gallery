<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel='stylesheet' href='/public/css/header.css'>
    <link type='text/css' rel='stylesheet' href='/public/css/home/main.css'>
    <title>Remembered</title>
</head>

<body>
    <?php include_once __DIR__ . '/../header.view.php'; ?>
    <h2 id="pagetitle">Remembered</h2>
    <form method="post" action="/public/remembered/remove">
        <button type="submit" id="rembutton">Remove selected</button>
        <div id="photoGallery">
            <?php if (!empty($data['remembered'])): ?>
            <?php foreach($data['remembered'] as $id): ?>
            <p><?php $data['remembered'] ?></p>
            <?php endforeach; ?>
            <?php endif ?>
            <?php if (!empty($data['photos'])): ?>
            <?php foreach($data['photos'] as $photo): ?>
            <div class="miniPhoto">
                <a href="/public/images/<?= basename($photo->fileWatermarkPath) ?>" target="_blank" class="photo">
                    <img class="thumbnail" src="/public/images/<?= basename($photo->fileThumbnailPath) ?>"
                        alt="thumbnail">
                </a>
                <div class="photo-info">
                    <p>Title: <?= $photo->title ?></p>
                    <p>Author: <?= $photo->authorname ?></p>
                    <div>
                        <label for="rmbrd">Remember</label>
                        <?php if (isset($_SESSION['remembered'])): ?>
                        <?php if (in_array(Photo::getId($photo->filePath), $_SESSION['remembered'])): ?>
                        <input type="checkbox" name="remembered[]" value="<?= Photo::getId($photo->filePath) ?>" ,
                            id="rmbrd">
                        <?php endif; ?>
                        <?php else: ?>
                        <input type="checkbox" name="remembered[]" value="<?= Photo::getId($photo->filePath) ?>"
                            id="rmbrd" checked>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif ?>
        </div>
    </form>
</body>

</html>