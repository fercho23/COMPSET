<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

class ErrorHandler {

    public static function respond($languageKeyName, $extraMessage='') {
        $message = Language::getInstance()->$languageKeyName;
        $message .= $extraMessage;
        $responder = new Responder();
        $responder->respond($message);
        // die($message);
    }

}

?>
