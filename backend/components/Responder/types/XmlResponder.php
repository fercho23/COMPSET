<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

include_once 'components/Responder/interface/ResponderInterface.php';

class XmlResponder implements ResponderInterface {
    private $httpState;

    /**
     * Convert an array to XML recursively
     * @param array $data to convert
     * @param SimpleXMLElement $xmlData root element
     */
    private function parse($data, &$xmlData) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key))
                    $key = 'item' . $key;

                $subnode = $xml_data->addChild($key);
                self::parse($value, $subnode);
            } else {
                $xml_data->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }

    public function setHttpState($state) {
        $this->httpState = $state;
    }

    public function respond($content) {
        if ($this->httpState)
            http_response_code($this->httpState);

        header('Content-Type: text/xml');

        $xml = new SimpleXMLElement('<response/>');
        self::parse($content, $xml);
        print $xml->asXML();
        exit;
    }

}

?>