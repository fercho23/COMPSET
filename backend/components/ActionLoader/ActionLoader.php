<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ActionLoader/interface/LoaderInterface.php';

class ActionLoader implements LoaderInterface {
    private $actionModule;
    private $actionClass = 'Index';

    public function getActionRequest() {
        return $this->actionModule.'-'.$this->actionClass;
    }

    public function getActionClass() {
        $filePath = MODULES_FOLDER.'/'.$this->actionModule.'/'.$this->actionClass.'.php';

        if (!file_exists($filePath))
            ErrorHandler::respond('unknown_action');

        include_once $filePath;

        if (!class_exists($this->actionClass))
            ErrorHandler::respond('unknown_action');

        return new $this->actionClass();
    }

    public function setRequest($actionRequest) {
        $actionData = explode('/', $actionRequest);
        $this->actionModule = $actionData[0];

        if (count($actionData) == 2)
            $this->actionClass = $actionData[1];

        if ($this->actionModule == '')
            ErrorHandler::respond('action_incorrect_format');
    }

    public function load(ActionInterface $action) {
        $action->execute();
    }

}

?>