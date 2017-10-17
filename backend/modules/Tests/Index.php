<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ActionLoader/interface/ActionInterface.php';

class Index implements ActionInterface
{
    public function execute()
    {
        $dataBaseHandler = new DatabaseHandler();
        $response = 'Hola Test-Index';
        //$response = $dataBaseHandler->exec('prGetUsers');

        $responder = new Responder();
        $responder->respond($response);
    }
}

?>