<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/InputHandler/interface/InputInterface.php';

class JsonInput implements InputInterface {
    private $inputs;

    public function __construct($data) {
        $data = json_decode($data);
        foreach ($data as $key => $value) {
            $this->inputs[$key] = $value;
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
