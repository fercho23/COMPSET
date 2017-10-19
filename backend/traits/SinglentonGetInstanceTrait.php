<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

trait SinglentonGetInstanceTrait {

    public static function getInstance() {
        if (!self::$instancia instanceof self)
            self::$instancia = new self;

        return self::$instancia;
    }

}

?>
