<?php
/**
* Copyright (c) 2013-2016 Gabriel Ferreira <gabrielinuz@gmail.com>. All rights reserved. 
* This file is part of COMPSET.
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
    // public function authorize(ActionInterface $action);
    public function authorize($actionModule, $actionClass);
}

?>