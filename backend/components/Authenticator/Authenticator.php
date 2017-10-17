<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/Authenticator/interface/AuthenticatorInterface.php';

class Authenticator implements AuthenticatorInterface {

    public function __construct() {
        $this->authenticated = false;
    }

    public function setDatabaseHandler(DatabaseHandlerInterface $dbh) {
        $this->dbh = $dbh;
    }

    public function getDatabaseHandler() {
        return $this->dbh;
    }

    public function setEncryptor(EncryptorInterface $encryptor) {
        $this->encryptor = $encryptor;
    }

    private function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function authenticate($userName, $password) {
        $storedUser = $this->dbh->exec('SELECT users.id,
                                        users.username,
                                        users.password 
                                        FROM users 
                                        WHERE users.username = ?', $userName);

        if (count($storedUser) != 0) {
            $storedUser = $storedUser[0];

            if (!empty($storedUser['id']))
                $this->setUserId($storedUser['id']);

            $this->authenticated = $this->encryptor->verify($password, $storedUser['password']);
        }

        return $this->authenticated;
    }
}

?>