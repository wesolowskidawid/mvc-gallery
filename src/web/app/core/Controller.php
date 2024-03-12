<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        // check if view exists
        if(file_exists('../app/views/' . $view . '.view.php'))
        {
            require_once '../app/views/' . $view . '.view.php';
        }
        else
        {
            die('View does not exist');
        }
    }

    public function redirect($url) {
        header('Location: ' . $url);
    }
}