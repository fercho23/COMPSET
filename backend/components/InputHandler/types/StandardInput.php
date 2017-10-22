<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/InputHandler/interface/InputInterface.php';

class StandardInput implements InputInterface {
    private $inputs;

    public function __construct($data) {
        $data = explode('&', $data);

        $inputSanitizer = new TextInputSanitizer;
        $data = $inputSanitizer->sanitize($data);

        $this->inputs = array();
        foreach ($data as $inputData) {
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

}

?>
