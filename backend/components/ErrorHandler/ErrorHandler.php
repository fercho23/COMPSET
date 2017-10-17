<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

class ErrorHandler {

    public static function die($languageKeyName) {
        $message = Language::getInstance()->$languageKeyName;
        $responder = new Responder();
        $responder->respond($message);
        // die($message);
    }

}

?>
