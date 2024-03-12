<?php

require_once __DIR__ . '/../../app/models/Database.php';

class Photo {
    public $id;
    public $title;
    public $authorname;
    public $filePath;
    public $fileWatermarkPath;
    public $fileThumbnailPath;
    public $visibility = 1; // 1 - public, 0 - private
    public $ownerId;

    public function __construct($title, $authorname, $filePath, $fileWatermarkPath, $fileThumbnailPath, $visibility, $ownerId = null) {
        $this->title = $title;
        $this->authorname = $authorname;
        $this->filePath = $filePath;
        $this->fileWatermarkPath = $fileWatermarkPath;
        $this->fileThumbnailPath = $fileThumbnailPath;
        $this->visibility = $visibility;
        $this->ownerId = $ownerId;
    }

    public function saveToMongoDB() {
        $db = Database::get_db();
        $collection = $db->photos;

        $document = [
            'title' => $this->title,
            'authorname' => $this->authorname,
            'filePath' => $this->filePath,
            'fileWatermarkPath' => $this->fileWatermarkPath,
            'fileThumbnailPath' => $this->fileThumbnailPath,
            'visibility' => $this->visibility,
            'ownerId' => $this->ownerId
        ];

        $result = $collection->insertOne($document);
        $this->id = $result->getInsertedId();

        return $this->id;
    }
    public static function getAllPhotos() {
        $db = Database::get_db();
        $collection = $db->photos;

        $cursor = $collection->find();
        $photos = [];
        foreach ($cursor as $document) {
            $photo = new Photo(
                $document['title'],
                $document['authorname'],
                $document['filePath'],
                $document['fileWatermarkPath'],
                $document['fileThumbnailPath'],
                $document['visibility'],
                $document['ownerId']
            );
            $photos[] = $photo;
        }
        return $photos;
    }
    public static function getAllPublicPhotos() {
        $db = Database::get_db();
        $collection = $db->photos;

        $cursor = $collection->find();
        $photos = [];
        foreach ($cursor as $document) {
            if($document['visibility'] == 1) {
                $photo = new Photo(
                    $document['title'],
                    $document['authorname'],
                    $document['filePath'],
                    $document['fileWatermarkPath'],
                    $document['fileThumbnailPath'],
                    $document['visibility'],
                    $document['ownerId']
                );
                $photos[] = $photo;
            }
        }
        return $photos;
    }
    public static function getId($filePath) {
        $db = Database::get_db();
        $collection = $db->photos;

        $document = $collection->findOne(['filePath' => $filePath]);
        return $document['_id'];
    }
    public static function getById($id) {
        $db = Database::get_db();
        $collection = $db->photos;

        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        $photo = new Photo(
            $document['title'],
            $document['authorname'],
            $document['filePath'],
            $document['fileWatermarkPath'],
            $document['fileThumbnailPath'],
            $document['visibility'],
            $document['ownerId']
        );
        $photo->id = $document['_id'];
        return $photo;
    }
}