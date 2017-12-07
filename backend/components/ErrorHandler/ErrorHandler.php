<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ErrorHandler/interface/ErrorHandlerInterface.php';

class ErrorHandler implements ErrorHandlerInterface {

    public static function respond($languageKeyName, $extraMessage='') {
        $message = Language::getInstance()->$languageKeyName;
        $message .= $extraMessage;
        $responder = new Responder();
        $responder->respond($message);
        // die($message);
    }

}

?>
