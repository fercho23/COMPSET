<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

interface AutoloaderInterface {
    public static function load($className);
    public static function setFileExt($fileExt);
    public static function setFolders($folders);
}

?>
