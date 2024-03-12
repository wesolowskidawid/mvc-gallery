<?php
require_once __DIR__ . '/../../app/models/Database.php';

class User {
    public $email;
    public $username;
    public $password;

    public function __construct($email, $username, $password) {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public function getId() {
        $collection = Database::get_db()->users;
        $userDocument = $collection->findOne(['username' => $this->username]);
        if($userDocument === null) {
            return null;
        }
        return $userDocument['_id'];
    }

    public function saveToDatabase() {
        $collection = Database::get_db()->users;
        
        $userDocument = [
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password
        ];

        $result = $collection->insertOne($userDocument);
        return $result->getInsertedId();
    }
    
    public static function isUsernameAvailable($username) {
        $collection = Database::get_db()->users;
        $existingUser = $collection->findOne(['username' => $username]);
        return $existingUser === null;
    }

    public static function loadByUsername($username) {
        $collection = Database::get_db()->users;
        $userDocument = $collection->findOne(['username' => $username]);
        if ($userDocument === null) {
            return null;
        }
        return new User(
            $userDocument['email'],
            $userDocument['username'],
            $userDocument['password']
        );
    }

    public static function loadById($id) {
        $collection = Database::get_db()->users;
        $userDocument = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        if ($userDocument === null) {
            return null;
        }
        return new User(
            $userDocument['email'],
            $userDocument['username'],
            $userDocument['password']
        );
    }
}