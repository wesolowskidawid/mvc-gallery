<?php

require_once __DIR__ . '/../../app/models/Photo.php';

class Home extends Controller
{
    public function index()
    {
        session_start();

        if(isset($_SESSION['user_id'])) {
            $allPhotos = Photo::getAllPhotos();
            $thumbnailAmount = count($allPhotos);
        }
        else {
            $allPhotos = Photo::getAllPublicPhotos();
            $thumbnailAmount = count($allPhotos);
        }
        $thyumbnailsPerPage = 6;
        $totalPages = ceil($thumbnailAmount / $thyumbnailsPerPage);
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $thyumbnailsPerPage;

        if(isset($_SESSION['user_id'])) {
            $allPhotos = Photo::getAllPhotos();
            $allPhotos = array_slice($allPhotos, $offset, $thyumbnailsPerPage);
            $this->view('home/index', ['currentPage' => $currentPage, 'totalPages' => $totalPages, 'photos' => $allPhotos, 'user' => $_SESSION['user_id']]);
        }
        else {
            $allPhotos = Photo::getAllPublicPhotos();
            $allPhotos = array_slice($allPhotos, $offset, $thyumbnailsPerPage);
            $this->view('home/index', ['currentPage' => $currentPage, 'totalPages' => $totalPages, 'photos' => $allPhotos, 'user' => '']);
        }
    }
}