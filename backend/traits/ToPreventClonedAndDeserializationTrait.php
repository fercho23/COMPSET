<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'traits/ToPreventClonedTrait.php';
require_once 'traits/ToPreventDeserializationTrait.php';

trait ToPreventClonedAndDeserializationTrait {

    use ToPreventClonedTrait;
    use ToPreventDeserializationTrait;

}

?>
