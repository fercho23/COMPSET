<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'traits/SinglentonGetInstanceTrait.php';
require_once 'traits/ToPreventClonedAndDeserializationTrait.php';

trait SinglentonTrait {

    use SinglentonGetInstanceTrait;
    use ToPreventClonedAndDeserializationTrait;

}

?>
