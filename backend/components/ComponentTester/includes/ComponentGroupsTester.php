<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ComponentTester/interface/ComponentGroupsTesterInterface.php';

class ComponentGroupsTester implements ComponentGroupsTesterInterface {
    private $groupsTests = array();
    private $response;
    public $green = 0;
    public $red = 0;

    public function addGroupTests(GroupTestsInterface $groupTests) {
        $this->groupsTests[] = $groupTests;
    }

    public function run() {
        // $this->response
        foreach ($this->groupsTests as $groupTests) {
            $methods = array_filter(get_class_methods($groupTests), function($value, $key) {
                return preg_match('/Test$/', $value) === 1;
            }, ARRAY_FILTER_USE_BOTH);

            $green = 0;
            $red = 0;
            $contentTests = '';
            foreach ($methods as $method) {
                $resultTest = $groupTests->$method();
                if ($resultTest) {
                    $green ++;
                    $test = $method;
                } else {
                    $red ++;
                    $test = $method;
                }
                $contentTests .= '<li class="w3-text-'.($resultTest ? 'green' : 'red').'">'.$test.'</li>';
            }
            $this->green += $green;
            $this->red += $red;

            $content = '<div class="groupTestsTitle" onclick="groupTestsToggle(this);">'.$groupTests->getTitle().'<small> '.($green + $red).' (<span class="w3-text-green">'.$green.'</span> / <span class="w3-text-red">'.$red.'</span>)</small> :</div>';
            $content .= '<ol class="groupTestsList">'.$contentTests.'</ol>';

            $this->response .= '<div class="groupTests">'.$content.'</div>';
            // $this->response .= '<li class="groupTests">'.$content.'</li>';
            // $this->response .= $content;
        }

        // $this->response .= '<li>'.$this->response.'</li>';

    }

    public function getResponse() {
        return $this->response;
    }

}

?>
