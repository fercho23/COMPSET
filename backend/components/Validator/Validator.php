<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'traits/ToPreventClonedAndDeserializationTrait.php';

class Validator {
    use ToPreventClonedAndDeserializationTrait;

    private static $instancia;

    private function __construct() {}

    public static function getInstance() {
        foreach (glob(COMPONENT_VALIDATOR_TYPES_FOLDER + '/*.php') as $filename) {
            include_once $filename;
        }
        if (!self::$instancia instanceof self)
            self::$instancia = new self;

        return self::$instancia;
    }

    // Cada validacion debe tener
    // evaluate
    // validate

}

?>
