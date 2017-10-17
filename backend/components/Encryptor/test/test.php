<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/


require_once 'components/ComponentFactory/ComponentFactory.php';
require_once 'components/Encryptor/Encryptor.php';

echo '<h1>*************************Encryptor Test***************************</h1>';

$encryptor = ComponentFactory::create('Encryptor');

if($encryptor) 
{
    echo '<h2>CREATION: OK</h2>';
} 
else
{
    echo '<h2>CREATION: FAIL</h2>';
}

$password = '12345';
$hash = $encryptor->encrypt('12345');
echo '<h2>HASH FOR ' . $password . ': '. $hash .' </h2>';

$verified = $encryptor->verify($password, $hash);
$verified = ($verified) ? 'TRUE' : 'FALSE';

echo '<h2>VERIFICATION FOR ' . $password . ': ' . $verified . '</h2>';

?>