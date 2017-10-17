<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/Authorizer/interface/AuthorizerInterface.php';

class Authorizer implements AuthorizerInterface {

    public function __construct() {
        $this->adminRoleId = 1;
        $this->authorized = false;
    }

    public function setAuthenticator(AuthenticatorInterface $authenticator) {
        $this->authenticator = $authenticator;
        $this->setDatabaseHandler($this->authenticator->getDatabaseHandler());
    }

    public function getAuthenticator() {
        return $this->authenticator;
    }

    public function setDatabaseHandler(DatabaseHandlerInterface $dbh) {
        $this->dbh = $dbh;
    }

    public function getDatabaseHandler() {
        return $this->dbh;
    }

    public function setAdminRoleId($adminRoleId) {
        $this->adminRoleId = $adminRoleId;
    }

    public function getAdminRoleId() {
        return $this->adminRoleId;
    }

    // private function setAction(ActionInterface $action) {
    private function setAction($actionModule, $actionClass) {
        // $this->action = $action;
        $this->action = $actionModule.'-'. $actionClass;
    }

    private function getActionId() {
        // $actionName =  get_class( $this->action );
        return $this->dbh->exec('select actions.id 
                                        from actions
                                        where actions.name = ?',
                                        $this->action)[0]['id'];
                                        // $actionName)[0]['id'];
    }

    private function isAdmin() {
        $userId = $this->authenticator->getUserId();
        $adminRoleId = $this->adminRoleId; 

        $isAdmin = $this->dbh->exec('select roles.* 
                                        from roles
                                        left join users_has_roles
                                        on users_has_roles.roles_id = roles.id
                                        where users_has_roles.users_id = ?
                                        and users_has_roles.roles_id = ?',
                                        array($userId, $adminRoleId)); 
        return ( $isAdmin != array() );
    }

    private function isAllowed() {
        $userId = $this->authenticator->getUserId();
        $actionId = $this->getActionId(); 

        $isAllowed = $this->dbh->exec('select roles.* 
                                        from roles
                                        left join users_has_roles
                                        on users_has_roles.roles_id = roles.id

                                        inner join roles_has_actions
                                        on roles_has_actions.roles_id = roles.id

                                        where users_has_roles.users_id = ?
                                        and roles_has_actions.actions_id = ?',
                                        array($userId, $actionId) );

        return ( $isAllowed != array() );
    }

    // public function authorize(ActionInterface $action) {
    public function authorize($actionModule, $actionClass) {
        // $this->setAction($action);
        $this->setAction($actionModule, $actionClass);
        $isAuthorized = ( $this->isAdmin() || $this->isAllowed() );
        if($isAuthorized) $this->authorized = true;
        return $this->authorized;
    }
}
?>