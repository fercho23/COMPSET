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
        $storedUser = $this->dbh->exec('select users.id,
                                        users.username,
                                        users.password 
                                        from users 
                                        where users.username = ?', $userName);

        if (count($storedUser) != 0) {
            // var_dump($storedUser);
            $storedUser = $storedUser[0];

            if (!empty($storedUser['id']))
                $this->setUserId($storedUser['id']);

            $isAuthenticated = $this->encryptor->verify($password, $storedUser['password']);

            if ($isAuthenticated)
                $this->authenticated = true;
        }

        return $this->authenticated;
    }
}

?>