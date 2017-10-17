<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/Accounter/interface/AccounterInterface.php';

class Accounter implements AccounterInterface {

    public function __construct() {
        $this->authorizer = false;
    }

    public function setDatabaseHandler(DatabaseHandlerInterface $dbh) {
        $this->dbh = $dbh;
    }

    public function setAuthorizer(AuthorizerInterface $authorizer) {
        $this->authorizer = $authorizer;
        $this->setDatabaseHandler($this->authorizer->getDatabaseHandler());
    }

    public function account() {
        $storedUser = $this->dbh->exec('select users.username from users 
                                        where users.id = ?', $this->authorizer->getAuthenticator()->getUserId());
        if (count($storedUser) != 0) {
            $storedUser = $storedUser[0];
            $userName = $storedUser['username'];
        }

        $actionRequest = $this->authorizer->getActionRequest();

        $datetime = date('Y-m-d H:i:s');
        // $datetime = 'Y-m-d H:i:s';
        var_dump($userName, $actionRequest, $datetime);
        $result = $this->dbh->exec('INSERT INTO logs (user_name, action_name, datetime)
                                    VALUES (?, ?, ?)',
                            array($userName, $actionRequest, $datetime));
        // var_dump($this->authorizer);
        var_dump($result);
    }
}

?>