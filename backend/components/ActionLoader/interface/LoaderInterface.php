<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

interface LoaderInterface {
    public function load(ActionInterface $action);
    public function setRequest($actionRequest);
    public function getActionRequest();
    public function getActionClass();
}

?>