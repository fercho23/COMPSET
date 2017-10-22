<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'traits/ToPreventClonedAndDeserializationTrait.php';
require_once 'traits/SinglentonGetInstanceTrait.php';

class Language {
    use ToPreventClonedAndDeserializationTrait;
    use SinglentonGetInstanceTrait;

   private static $instancia;
   private $words;

    private function __construct() {
        $this->words = require_once COMPONENT_LANGUAGES_FOLDER.'/'.strtolower(defined('LANGUAGE') ? LANGUAGE : LANGUAGE_DEFAULT).'.php';
    }

    public function __get($field) {
        // return $this->words[$field];
        return htmlentities($this->words[$field], 0, 'UTF-8');
    }

}

?>