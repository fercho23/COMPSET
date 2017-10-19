<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

trait ToPreventDeserializationTrait {

    // To Prevent Deserialization:
    public function __wakeup() {
        trigger_error (
            'Invalid Operation: You cannot deserialize an instance of '
            . get_class($this) ." class."
        );
    }


}

?>
