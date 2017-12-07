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

final class TestsApplication {

    public static function run() {
        AutoloaderComponents::run();


        $componentTester = new ComponentTester();
        $componentTester->setComponentToTest('Encryptor', 'Super Encryptor');
        $componentTester->runAllTests();

        $responder = new Responder();
        $responder->respond($componentTester->getResponse());
    }
}

?>