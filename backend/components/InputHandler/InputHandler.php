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

    private function __construct() {
        $inputSanitizer = new TextInputSanitizer;
        $allInputs = $inputSanitizer->sanitize(explode('&', file_get_contents('php://input')));

        $this->inputs = array();
        foreach ($allInputs as $inputData) {
            $input = explode('=', $inputData);
            $this->inputs[$input[0]] = $input[1];
        }
    }

    public function get($name) {
        return $this->inputs[$name];
    }

    public function isset($name) {
        return isset($this->inputs[$name]);
    }

    public function checkInputRequired() {
        $inputsRequired = array();
        $inputsRequired['user'] = 'post_user_required';
        $inputsRequired['password'] = 'post_password_required';
        $inputsRequired['action'] = 'post_action_required';

        foreach ($inputsRequired as $inputName => $languageKeyName) {
            if (!isset($this->inputs[$inputName]))
                ErrorHandler::respond($languageKeyName);
        }
    }


}

?>
