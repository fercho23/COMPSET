<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/Autoloader/interface/AutoloaderInterface.php';

class Autoloader implements AutoloaderInterface {
    /**
     * File extension as a string. Defaults to ".php".
     */
    protected static $fileExt = '.php';
    /**
     * The top level directory where recursion will begin. Defaults to the current
     * directory.
     */
    protected static $foldersPath = [];

    /**
     * Autoload function for registration with spl_autoload_register
     *
     * Looks recursively through project directory and loads class files based on
     * filename match.
     *
     * @param string $className
     */
    public static function load($className) {
        if (!class_exists($className)) {
            // $className = '/'.strtolower($className.static::$fileExt);
            foreach (static::$foldersPath as $folder) {
                // $path = strtolower($_SESSION['directorioBase'].$folder).$className;
                $path = $folder.'/'.$className.'/'.$className.static::$fileExt;
                if (file_exists($path)) {
                    require_once $path;
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Sets the $fileExt property
     *
     * @param string $fileExt The file extension used for class files. Default is "php".
     */
    public static function setFileExt($fileExt) {
        static::$fileExt = $fileExt;
    }

    /**
     * Sets the $folders property
     *
     * @param string $folders The folders representing the top level where recursion should
     *                     begin. Defaults to the current directory.
     */
    public static function setFolders($folders) {
        if (!is_array($folders))
            $folders = [$folders];
        static::$foldersPath = $folders;
    }
}

?>