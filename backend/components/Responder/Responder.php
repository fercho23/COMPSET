<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/Responder/interface/ResponderInterface.php';
require_once 'components/Responder/config/ini.php';

class Responder implements ResponderInterface {
    private $responder;

    public function __construct() {
        $header = HeaderHandler::getInstance();

        $acceptType = strtolower($header->isset('Accept') ? $header->get('Accept') : COMPONENT_RESPONDER_CONTENT_INCLUDES_TO_SEND_DEFAULT);

        switch ($acceptType) {
            case 'json':
            case 'application/json':
                $className = 'Json';
                break;

            case 'xml':
            case 'application/xml':
                $className = 'Xml';
                break;

            case 'html':
            case 'text/html':
                $className = 'Html';
                break;
        }

        $className = $className.'Responder';
        $responder = IncludesFactory::create($className, 'Responder');
        if ($responder === null)
            ErrorHandler::respond('unknown_responder_type');

        $this->responder = $responder;
    }

    public function setHttpState($state) {
        $this->responder->setHttpState($state);
    }

    public function respond($content) {
        $this->responder->respond($content);
    }
}

?>