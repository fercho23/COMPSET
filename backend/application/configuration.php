<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

define('LANGUAGE_DEFAULT', 'es');

define('MODULES_FOLDER', 'modules');
define('COMPONENT_RESPONDER_TYPES_FOLDER', 'components/Responder/types');
define('COMPONENT_LANGUAGES_FOLDER', 'components/Language/languages');
define('AUTOLOADER_FOLDERS', 'components');
// define('AUTOLOADER_FOLDERS',
//     array(
//         'components'
//     )
// );

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