<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

interface AuthenticatorInterface {
    public function setDatabaseHandler(DatabaseHandlerInterface $dbh);
    public function getDatabaseHandler();
    public function setEncryptor(EncryptorInterface $encryptor);
    public function getUserId();
    public function authenticate($userName, $password);
}

?>