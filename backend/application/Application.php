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

        if (!isset($_POST))
            ErrorHandler::respond('post_required');

        // LANGUAGE
            // $_POST['language'] = 'en';
            $language = LANGUAGE_DEFAULT;
            if (isset($_POST['language']))
                $language = strtolower($_POST['language']);
            define('LANGUAGE', $language);
        // -- LANGUAGE

        // REQUIRED DATA
            if (!isset($_POST['user']))
                ErrorHandler::respond('post_user_required');

            if (!isset($_POST['password']))
                ErrorHandler::respond('post_password_required');

            if (!isset($_POST['action']))
                ErrorHandler::respond('post_action_required');
        // -- REQUIRED DATA

        // SANITIZER
            $inputSanitizer = new TextInputSanitizer;
            if (isset($_POST))
                $_POST = $inputSanitizer->sanitize($_POST);
        // -- SANITIZER

        // AUTHENTICATOR
            $authenticator = new Authenticator();
            $authenticator->setDatabaseHandler(new DatabaseHandler());
            $authenticator->setEncryptor(new Encryptor());
            $authenticated = $authenticator->authenticate($_POST['user'], $_POST['password']);

            if (!$authenticated)
                ErrorHandler::respond('authentication_error');
        // -- AUTHENTICATOR

        // ACTION LOADER
            $actionLoader = new ActionLoader();
            $actionLoader->setRequest($_POST['action']);
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