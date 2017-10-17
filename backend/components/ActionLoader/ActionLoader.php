<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ActionLoader/interface/LoaderInterface.php';
require_once 'components/ActionLoader/interface/ActionInterface.php';

class ActionLoader implements LoaderInterface {

    public function load(ActionInterface $action) {
        $action->execute();
    }
}

?>