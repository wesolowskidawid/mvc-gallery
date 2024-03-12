<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel='stylesheet' href='/public/css/home/main.css'>
    <link type='text/css' rel='stylesheet' href='/public/css/header.css'>
    <title>Gallery</title>
    <style>
    .thumbnail {
        margin: 10px;
        width: 200px;
        height: 125px;
        object-fit: cover;
    }
    </style>
</head>

<body>
    <?php include_once __DIR__ . '/../header.view.php'; ?>
    <main>
        <h2 id="pagetitle">Home</h2>
        <p><?php $data['user'] ?></p>
        <form method="post" action="/public/remembered/add">
            <?php if (isset($_SESSION['user_id'])): ?>
            <button type="submit" id="rembutton">Remember selected</button>
            <?php endif; ?>
            <div id="photoGallery">
                <?php foreach($data['photos'] as $photo): ?>
                <?php if (isset($_SESSION['user_id']) && $photo->ownerId == $_SESSION['user_id'] && !$photo->visibility): ?>
                <div class="miniPhoto">
                    <a href="/public/images/<?= basename($photo->fileWatermarkPath) ?>" target="_blank" class="photo">
                        <img class="thumbnail" src="/public/images/<?= basename($photo->fileThumbnailPath) ?>"
                            alt="thumbnail">
                    </a>
                    <div class="photo-info">
                        <p>Title: <?= $photo->title ?></p>
                        <p>Author: <?= $photo->authorname ?></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <div>
                            <label for="rmbrd">Remember</label>
                            <?php if (isset($_SESSION['remembered']) && in_array(Photo::getId($photo->filePath), $_SESSION['remembered'])): ?>
                            <input type="checkbox" name="remembered[]" value="<?= Photo::getId($photo->filePath) ?>"
                                id="rmbrd" checked>
                            <?php else: ?>

                            <input type="checkbox" name="remembered[]" value="<?= Photo::getId($photo->filePath) ?>" ,
                                id="rmbrd">
                            <?php endif; ?>
                        </div>
                        <p>Private</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php elseif ($photo->visibility): ?>
                <div class="miniPhoto">
                    <a href="/public/images/<?= basename($photo->fileWatermarkPath) ?>" target="_blank" class="photo">
                        <img class="thumbnail" src="/public/images/<?= basename($photo->fileThumbnailPath) ?>"
                            alt="thumbnail">
                    </a>
                    <div class="photo-info">
                        <p>Title: <?= $photo->title ?></p>
                        <p>Author: <?= $photo->authorname ?></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <div>
                            <label for="rmbrd">Remember</label>
                            <?php if (isset($_SESSION['remembered']) && in_array(Photo::getId($photo->filePath), $_SESSION['remembered'])): ?>
                            <input type="checkbox" name="remembered[]" value="<?= Photo::getId($photo->filePath) ?>"
                                id="rmbrd" checked>
                            <?php else: ?>

                            <input type="checkbox" name="remembered[]" value="<?= Photo::getId($photo->filePath) ?>" ,
                                id="rmbrd">
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </form>

        <br>

        <div class="pages">
            <?php
        for ($page = 1; $page <= $data['totalPages']; $page++) { echo '<a href="?page=' . $page . '">' . $page . '</a> '
            ; } ?>
        </div>
    </main>
</body>

</html>