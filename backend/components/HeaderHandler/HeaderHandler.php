<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/HeaderHandler/interface/HeaderHandlerInterface.php';

require_once 'traits/SinglentonTrait.php';

class HeaderHandler implements HeaderHandlerInterface {
    use SinglentonTrait;

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
