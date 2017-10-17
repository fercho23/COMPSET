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

            // ErrorHandler::die('post_required');
        if (!isset($_POST))
            ErrorHandler::die('post_required');

        // LANGUAGE
            // $_POST['language'] = 'en';
            $language = LANGUAGE_DEFAULT;
            if (isset($_POST['language']))
                $language = strtolower($_POST['language']);
            define('LANGUAGE', $language);
        // -- LANGUAGE

        // REQUIRED DATA
            if (!isset($_POST['user']))
                ErrorHandler::die('post_user_required');

            if (!isset($_POST['password']))
                ErrorHandler::die('post_password_required');

            if (!isset($_POST['action']))
                ErrorHandler::die('post_action_required');
        // -- REQUIRED DATA

        // SANITIZER
            $inputSanitizer = new TextInputSanitizer;
            if (isset($_POST))
                $_POST = $inputSanitizer->sanitize($_POST);
            // var_dump($_POST);
            // $_POST['user'] = 'admin';
             //$_POST['password'] = '123456';
        // -- SANITIZER

        // TEST AUTHENTICATOR
            $authenticator = new Authenticator();
            $authenticator->setDatabaseHandler(new DatabaseHandler());
            $authenticator->setEncryptor(new Encryptor());
            $authenticated = $authenticator->authenticate($_POST['user'], $_POST['password']);

            if (!$authenticated)
                ErrorHandler::die('authentication_error');
        // -- TEST AUTHENTICATOR

        // ACTION CONSTRUCT
            $actionData = explode('/', $_POST['action']);
            $actionModule = $actionData[0];

            $actionClass = 'Index';
            if (count($actionData) == 2)
                $actionClass = $actionData[1];

            if ($actionModule == '')
                ErrorHandler::die('action_incorrect_format');
        // -- ACTION CONSTRUCT

        // TEST AUTHORIZER
            $authorizer = new Authorizer();
            $authorizer->setAuthenticator($authenticator);
            $authorized = $authorizer->authorize($actionModule, $actionClass);
            // $authorized = $authorizer->authorize($actionObject);
            //var_dump($authorized);

            if (!$authorized)
                ErrorHandler::die('authorization_error');
        // -- TEST AUTHORIZER

        // ACTION CONSTRUCT
            $filePath = MODULES_FOLDER.'/'.$actionModule.'/'.$actionClass.'.php';
            if (!file_exists($filePath))
                ErrorHandler::die('unknown_action');
            include_once $filePath;
            if (!class_exists($actionClass))
                ErrorHandler::die('unknown_action');

            $actionObject = new $actionClass();
        // -- ACTION CONSTRUCT

        // TEST ACCOUNTER
            // $accounter = ComponentFactory::create('Accounter');
            // $accounter->setAuthorizer($authorizer);
            // $accounter->account();
        // -- TEST ACCOUNTER

        // ACTION LOADER
            $actionLoader = new ActionLoader();
            $actionLoader->load($actionObject);
        //--  ACTION LOADER
    }
}

?>