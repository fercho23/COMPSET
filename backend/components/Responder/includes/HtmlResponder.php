<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/Responder/interface/ResponderInterface.php';

class HtmlResponder implements ResponderInterface {

    private $httpState;

    public function setHttpState($state) {
        $this->httpState = $state;
    }

    public function respond($content) {
        if ($this->httpState)
            http_response_code($this->httpState);

        header('Content-Type: text/html; charset=utf8');
        echo $content;
        exit;
    }

}

?>