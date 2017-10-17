<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/Autoloader/Autoloader.php';

final class AutoloaderComponents
{
    public static function run()
    {
        // Nullify any existing autoloads
        spl_autoload_register(null, false);

        // Specify extensions that may be loaded
        spl_autoload_extensions('.php');

        // Get Folders
        $folders = AUTOLOADER_FOLDERS;

        // Set Folders
        Autoloader::setFolders($folders);

        // Register the loader functions
        spl_autoload_register('Autoloader::load');
    }
}

?>