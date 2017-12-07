<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/InputHandler/interface/InputInterface.php';

require_once 'traits/SinglentonTrait.php';

class InputHandler implements InputInterface {
    use SinglentonTrait;

    private static $instancia;
    private $inputType;
    private $contentType;

    private function __construct() {
        $headers = HeaderHandler::getInstance();
        $this->contentType = strtolower($headers->isset('Content-Type') ? $headers->get('Content-Type') : '');

        $inputType = $this->getInputType();
        $this->setInputType($inputType);
    }

    public function get($name) {
        return $this->inputType->get($name);
    }

    public function isset($name) {
        return $this->inputType->isset($name);
    }

    public function checkInputRequired() {
        $inputsRequired = array();
        $inputsRequired['user'] = 'post_user_required';
        $inputsRequired['password'] = 'post_password_required';
        $inputsRequired['action'] = 'post_action_required';

        foreach ($inputsRequired as $inputName => $languageKeyName) {
            if (!$this->isset($inputName))
                ErrorHandler::respond($languageKeyName);
        }
    }

    private function getInputType() {
        $data = file_get_contents('php://input');

        switch ($this->contentType) {
            case 'json':
            case 'application/json':
                $className = 'Json';
                break;

            case 'xml':
            case 'application/xml':
                $className = 'Xml';
                break;

            default:
                $className = 'Standard';
                break;
        }

        $className = $className.'Input';

        $inputHandler = IncludesFactory::createWithData($className, 'InputHandler', $data);
        if ($inputHandler === null)
            ErrorHandler::respond('unknown_input_type');

        return $inputHandler;

        // $filePath = COMPONENT_INPUT_HANDLER_TYPES_FOLDER.'/'.$className.'.php';

        // if (!file_exists($filePath))
        //     ErrorHandler::respond('unknown_input_type');

        // include_once $filePath;

        // if (!class_exists($className))
        //     ErrorHandler::respond('unknown_input_type');

        // return new $className($data);
    }

    private function setInputType(InputInterface $inputType) {
        $this->inputType = $inputType;

    }

}

?>
