<?php
class Thumbnail {
    public function getAmount() {
        $folder = __DIR__ . '/../../public/images/';
        $filePattern = $folder . '/*_thumbnail.*';
        $files = glob($filePattern);
        return count($files);
    }

    public function getThumbnails($offset, $thumbnailsPerPage) {
        $folder = __DIR__ . '/../../public/images/';
        $filePattern = $folder . '/*_thumbnail.*';
        $files = glob($filePattern);
        $thumbnails = array_slice($files, $offset, $thumbnailsPerPage);
        return $thumbnails;
    }

    public function getWatermarks($offset, $watermarksPerPage) {
        $folder = __DIR__ . '/../../public/images/';
        $filePattern = $folder . '/*_watermark.*';
        $files = glob($filePattern);
        $watermarks = array_slice($files, $offset, $watermarksPerPage);
        return $watermarks;
    }
}