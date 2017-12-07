<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

interface ComponentTesterInterface {
    public function setComponentToTest($componentToTest, $titleToShow);
    public function runAllTests();
    public function getResponse();
}

?>
