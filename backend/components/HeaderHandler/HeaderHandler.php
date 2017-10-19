<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'traits/ToPreventClonedAndDeserializationTrait.php';
include_once 'traits/SinglentonGetInstanceTrait.php';

class HeaderHandler {
    use ToPreventClonedAndDeserializationTrait;
    use SinglentonGetInstanceTrait;

    private static $instancia;
    private $headers;

    private function __construct() {
        $this->headers = apache_request_headers();
    }

    public function get($name) {
        return $this->headers[$name];
    }

    public function isset($name) {
        return isset($this->headers[$name]);
    }

}

?>
