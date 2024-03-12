<?php

require_once __DIR__ . '/../../app/models/Photo.php';
require_once __DIR__ . '/../../app/models/User.php';

class Upload extends Controller
{
    public function index()
    {
        // session
        session_start();
        if(isset($_SESSION['user_id'])) {
            $loggedUser = User::loadById($_SESSION['user_id']);
            $username = $loggedUser->username;
            $this->view('upload/index', ['username' => $username]);
        }
        else {
            $this->view('upload/index');
        }
        
    }

    public function process()
    {
        $target_dir = "images/";
        $uniqueID = uniqid();
        $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $newFile = $target_dir . $uniqueID . '.' . $imageFileType;
        $uploadOk = 1;
        $maxFileSize = 1*1024*1024; // 1 MB
        $errorMessege = 'Sorry, your file was not uploaded.';
        $watermark = $_POST['watermark'];
        $watermarkImagePath = $target_dir . $uniqueID . '_watermark.' . $imageFileType;
        $thumbnailImagePath = $target_dir . $uniqueID . '_thumbnail.' . $imageFileType;
        if(isset($_POST['visibility'])) {
            $visibility = 0;
        }
        else {
            $visibility = 1;
        }

        // check if file is an image
        if(isset($_POST['submit']) && !empty($_FILES['fileToUpload']['tmp_name']))
        {
            $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
            if($check !== false)
            {
                $uploadOk = 1;
            }
            else
            {
                $uploadOk = 0;
            }
        }

        // check if file already exists
        if(file_exists($newFile))
        {
            $uploadOk = 0;
        }

        // check file size
        if($_FILES['fileToUpload']['size'] > $maxFileSize)
        {
            $uploadOk = 0;
            $this->view('upload/process', ['message' => 'Sorry, your file is too large.']);
        }

        // allow certain file formats
        if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg')
        {
            $uploadOk = 0;
            $this->view('upload/process', ['message' => 'Sorry, only JPG, JPEG, PNG files are allowed.']);
        }

        // check if $uploadOk is set to 0 by an error
        if($uploadOk == 0)
        {
            $this->view('upload/process', ['message' => $errorMessege]);
        }
        else
        {
            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $newFile))
            {
                // determing image creation by type
                switch($imageFileType)
                {
                    case 'jpg':
                    case 'jpeg':
                        $createImage = 'imagecreatefromjpeg';
                        $saveImage = 'imagejpeg';
                        break;
                    case 'png':
                        $createImage = 'imagecreatefrompng';
                        $saveImage = 'imagepng';
                        break;
                    default:
                        die('Unsupported file format');
                }
                // create watermark
                $watermarkImage = $createImage($newFile);
                $fontSize = 20;
                $textColor = imagecolorallocate($watermarkImage, 255, 255, 255);
                $font = __DIR__ . '/../../public/fonts/Lato-Regular.ttf';
                $x = imagesx($watermarkImage) - (strlen($watermark) * $fontSize) - 10;
                $y = imagesy($watermarkImage) - 10;
                imagefttext($watermarkImage, $fontSize, 0, $x, $y, $textColor, $font, $watermark);
                $saveImage($watermarkImage, $watermarkImagePath);

                // create thumbnail
                $thumbnail = imagecreatetruecolor(200, 125);
                $sourceImage = $createImage($newFile);
                imagecopyresized($thumbnail, $sourceImage, 0, 0, 0, 0, 200, 125, imagesx($sourceImage), imagesy($sourceImage));
                $saveImage($thumbnail, $thumbnailImagePath);

                // getuser
                session_start();
                if(isset($_SESSION['user_id'])) {
                    $photo = new Photo($_POST['title'], $_POST['author'], $newFile, $watermarkImagePath, $thumbnailImagePath, $visibility, $_SESSION['user_id']);
                }
                else {
                    $photo = new Photo($_POST['title'], $_POST['author'], $newFile, $watermarkImagePath, $thumbnailImagePath, $visibility);
                }

                // save to database
                $photo->saveToMongoDB();

                $this->view('upload/process', ['message' => 'Your file has been uploaded successfully.']);
            }
            else
            {
                $this->view('upload/process', ['message' => $errorMessege]);
            }
        }
    }
}