<?php
use MongoDB\Client;
class Database
{
    public static function get_db() {
        $mongo = new MongoDB\Client("mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);
        return $mongo->wai;
    }
}