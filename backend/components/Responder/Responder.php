<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'components/Responder/interface/ResponderInterface.php';

class Responder implements ResponderInterface {
    private $responder;

    public function __construct($responseType='Json') {
        $className = ucwords($responseType).'Responder';
        $filePath = COMPONENT_RESPONDER_TYPES_FOLDER.'/'.$className.'.php';

        if (!file_exists($filePath))
            ErrorHandler::respond('unknown_responder_type');

        include_once $filePath;

        if (!class_exists($className))
            ErrorHandler::respond('unknown_responder_type');

        $this->responder = new $className();
    }

    public function setHttpState($state) {
        $this->responder->setHttpState($state);
    }

    public function respond($content) {
        $this->responder->respond($content);
    }
}

?>