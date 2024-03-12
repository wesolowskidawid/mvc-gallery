<?php
require_once __DIR__ . '/../../app/models/Photo.php';

class Remembered extends Controller {
    public function index() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            if(isset($_SESSION['remembered'])) {
                $remembered = $_SESSION['remembered'];
                if(empty($remembered)) {
                    $this->view('remembered/index');
                    return;
                }
                $photos = [];
                foreach($remembered as $id) {
                    $photo = Photo::getById($id);
                    array_push($photos, $photo);
                }
                $this->view('remembered/index', ['photos' => $photos, 'remembered' => $remembered]);
            }
            else {
                $this->view('remembered/index');
            }
        }
        else {
            header('Location: /public');
        }
    }
    public function add() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!isset($_POST['remembered'])) {
                unset($_SESSION['remembered']);
                header('Location: /public');
                return;
            }
            if(isset($_SESSION['remembered'])) {
                $remembered = $_SESSION['remembered'];
                if(empty($remembered)) {
                    $_SESSION['remembered'] = $_POST['remembered'];
                    header('Location: /public');
                    return;
                }
                foreach($_POST['remembered'] as $id) {
                    if(!in_array($id, $remembered)) {
                        array_push($remembered, $id);
                    }
                }
                $_SESSION['remembered'] = $remembered;
            }
            else {
                $_SESSION['remembered'] = $_POST['remembered'];
            }
            header('Location: /public');
        }
        else {
            header('Location: /public');
        }
    }
    public function remove() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!isset($_POST['remembered'])) {
                $_SESSION['remembered'] = [];
                header('Location: /public/remembered');
                return;
            }
            if(isset($_SESSION['remembered'])) {
                $remembered = $_SESSION['remembered'];
                if(empty($remembered)) {
                    header('Location: /public/remembered');
                    return;
                }
                foreach($_POST['remembered'] as $id) {
                    if(in_array($id, $remembered)) {
                        $key = array_search($id, $remembered);
                        unset($remembered[$key]);
                    }
                }
                $_SESSION['remembered'] = $remembered;
            }
            else {
                header('Location: /public/remembered');
            }
            header('Location: /public/remembered');
        }
        else {
            header('Location: /public');
        }
    }
}