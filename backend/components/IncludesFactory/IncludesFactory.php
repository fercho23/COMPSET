<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/IncludesFactory/interface/IncludesFactoryInterface.php';

class IncludesFactory implements IncludesFactoryInterface {

    public static function create($includeName, $componentName) {
        // $return = null;

        // $filePath = COMPONENTS_FOLDERS.'/'.$componentName.'/includes/'.$includeName.'.php';

        // if (file_exists($filePath)) {
        //     include_once $filePath;

        //     if (class_exists($includeName))
        //         $return = new $includeName;
        // }

        // return $return;
        return IncludesFactory::createWithData($includeName, $componentName, null);
    }

    public static function createWithData($includeName, $componentName, $data) {
        $return = null;

        $filePath = COMPONENTS_FOLDERS.'/'.$componentName.'/includes/'.$includeName.'.php';

        if (file_exists($filePath)) {
            include_once $filePath;

            if (class_exists($includeName))
                $return = $data !== null ? new $includeName($data) : new $includeName;
        }

        return $return;
    }

}

?>
