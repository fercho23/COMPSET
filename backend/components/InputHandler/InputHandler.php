<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'traits/ToPreventClonedAndDeserializationTrait.php';
include_once 'traits/SinglentonGetInstanceTrait.php';

class InputHandler {
    use ToPreventClonedAndDeserializationTrait;
    use SinglentonGetInstanceTrait;

    private static $instancia;
    private $inputs;
    private $contentType;

    private function __construct() {
        $headers = HeaderHandler::getInstance();
        $this->contentType = strtolower($headers->isset('Content-Type') ? $headers->get('Content-Type') : '');
        $this->setInputs();
    }

    public function get($name) {
        switch ($this->contentType) {
            case 'xml':
            case 'application/xml':
                $data = $this->inputs->$name;
                break;

            default:
                $data = $this->inputs[$name];
                break;
        }
        return $data;
        // return $this->inputs[$name];
    }

    public function isset($name) {
        switch ($this->contentType) {
            case 'xml':
            case 'application/xml':
                $data = isset($this->inputs->$name);
                break;

            default:
                $data = isset($this->inputs[$name]);
                break;
        }
        return $data;
        // return isset($this->inputs[$name]);
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

    private function setInputs() {
        $allInputs = file_get_contents('php://input');

        switch ($this->contentType) {
            case 'json':
            case 'application/json':
                $allInputs = json_decode($allInputs);
                foreach ($allInputs as $key => $value) {
                    $this->inputs[$key] = $value;
                }
                break;

            case 'xml':
            case 'application/xml':
                $this->inputs = new SimpleXMLElement($allInputs);
                break;

            default:
                $allInputs = explode('&', $allInputs);

                $inputSanitizer = new TextInputSanitizer;
                $allInputs = $inputSanitizer->sanitize($allInputs);

                $this->inputs = array();
                foreach ($allInputs as $inputData) {
                    $input = explode('=', $inputData);
                    $this->inputs[$input[0]] = $input[1];
                }
                break;
        }

    }

}

?>
