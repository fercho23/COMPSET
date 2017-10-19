<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

define('LANGUAGE_DEFAULT', 'es');

// define('CONTENT_TYPE_TO_SEND', 'es');

define('MODULES_FOLDER', 'modules');
define('COMPONENTS_FOLDERS', 'components');

// COMPONENTS
    // COMPONENT_RESPONDER
        define('COMPONENT_RESPONDER_TYPES_FOLDER', 'components/Responder/types');
        define('COMPONENT_RESPONDER_CONTENT_TYPE_TO_SEND_DEFAULT', 'application/json');
    // -- COMPONENT_RESPONDER

    // COMPONENT_LANGUAGE
    define('COMPONENT_LANGUAGES_FOLDER', 'components/Language/languages');
    // -- COMPONENT_LANGUAGE

// -- COMPONENTS


// DATABASE
    // MESSAGES
        define('CT_DATABASE_CONNECTION_ERROR', 'Error on Database connection! system message: ');
        define('CT_DATABASE_TRANSACTION_ERROR', '¡Error on SQL Transaction! system message: ');
    // -- MESSAGES

    // CONNECTION FOR SQLITE
        define('CT_DATABASE_ENGINE', 'sqlite');
        define('CT_DATABASE_FILE_PATH', 'database/db.sqlite');
        define('CT_DATABASE_CHARSET', 'utf8');
    // -- CONNECTION FOR SQLITE

    // CONNECTION FOR MYSQL
        // define('CT_DATABASE_ENGINE', 'mysql');
        // define('CT_DATABASE_HOST', 'localhost');
        // define('CT_DATABASE_NAME', '****');
        // define('CT_DATABASE_USER', '****');
        // define('CT_DATABASE_PASS', '****');
        // define('CT_DATABASE_CHARSET', 'utf8');
    // -- CONNECTION FOR MYSQL

    // CONNECTION FOR POSTGRESQL
        // define('CT_DATABASE_ENGINE', 'pgsql');
        // define('CT_DATABASE_HOST', 'localhost');
        // define('CT_DATABASE_NAME', '****');
        // define('CT_DATABASE_USER', '****');
        // define('CT_DATABASE_PASS', '****');
        // define('CT_DATABASE_CHARSET', 'utf8');
    // -- CONNECTION FOR POSTGRESQL
// -- DATABASE

?>