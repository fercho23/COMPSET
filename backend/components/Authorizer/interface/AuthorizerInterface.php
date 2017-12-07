<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

interface AuthorizerInterface {
    public function setAuthenticator(AuthenticatorInterface $authenticator);
    public function getAuthenticator();
    public function setDatabaseHandler(DatabaseHandlerInterface $dbh);
    public function getDatabaseHandler();
    public function setAdminRoleId($adminRoleId);
    public function getAdminRoleId();
    public function getActionRequest();
    public function authorize($action);
    // public function authorize(ActionInterface $action);
}

?>