<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

class Language {

   private static $instancia;
   private $words;

    private function __construct() {
        $this->words = require_once COMPONENT_LANGUAGES_FOLDER.'/'.strtolower(defined('LANGUAGE') ? LANGUAGE : LANGUAGE_DEFAULT).'.php';
    }

    public static function getInstance() {
        if (!self::$instancia instanceof self)
            self::$instancia = new self;

        return self::$instancia;
    }

    public function __get($field) {
        // return $this->words[$field];
        return htmlentities($this->words[$field], 0, 'UTF-8');
    }

    /*** to_prevent cloned: ***/
    public function __clone()
    {
        trigger_error
        (
            'Invalid Operation: You cannot clone an instance of '
            . get_class($this) ." class.", E_USER_ERROR 
        );
    }

    /*** to prevent deserialization: ***/
    public function __wakeup()
    {
        trigger_error
        (
            'Invalid Operation: You cannot deserialize an instance of '
            . get_class($this) ." class."
        );
    }

}

?>