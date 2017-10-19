<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

require_once 'configuration.php';
require_once 'AutoloaderComponents.php';

final class Application {

    public static function run() {
        AutoloaderComponents::run();

        $input = InputHandler::getInstance();

        // LANGUAGE
            $language = LANGUAGE_DEFAULT;
            if ($input->isset('language'))
                $language = strtolower($input->get('language'));
            define('LANGUAGE', $language);
        // -- LANGUAGE

        // REQUIRED DATA
            $input->checkInputRequired();
        // -- REQUIRED DATA

        // AUTHENTICATOR
            $authenticator = new Authenticator();
            $authenticator->setDatabaseHandler(new DatabaseHandler());
            $authenticator->setEncryptor(new Encryptor());
            $authenticated = $authenticator->authenticate($input->get('user'), $input->get('password'));

            if (!$authenticated)
                ErrorHandler::respond('authentication_error');
        // -- AUTHENTICATOR

        // ACTION LOADER
            $actionLoader = new ActionLoader();
            $actionLoader->setRequest($input->get('action'));
            $actionObject = $actionLoader->getActionClass();
        // -- ACTION LOADER

        // AUTHORIZER
            $authorizer = new Authorizer();
            $authorizer->setAuthenticator($authenticator);
            $authorized = $authorizer->authorize($actionLoader->getActionRequest());
            if (!$authorized)
                ErrorHandler::respond('authorization_error');
        // -- AUTHORIZER

        // ACCOUNTER
            $accounter = new Accounter();
            $accounter->setAuthorizer($authorizer);
            $accounter->account();
        // -- ACCOUNTER

        // ACTION LOADER
            $actionLoader->load($actionObject);
        //--  ACTION LOADER
    }
}

?>