<?php
/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

require_once 'components/ComponentTester/interface/ComponentTesterInterface.php';
require_once 'components/ComponentTester/includes/ComponentGroupsTester.php';

class ComponentTester implements ComponentTesterInterface {
    private $componentsToTest = array();
    // private $componentsGroupsTester = array();

    private $response;

    // PUBLIC
        public function setComponentToTest($componentName, $titleToShow = null) {
            if ($titleToShow === null)
                $titleToShow = $componentName.' Tests';

            $componentTests = array();
            $componentTests['name'] = $componentName;
            $componentTests['title'] = $titleToShow;
            $componentTests['testGroupNames'] = array();
            $componentTests['groupsTester'] = null;

            $this->componentsToTest[] = $componentTests;
        }

        public function runAllTests() {
            $this->includeAllTests();
            $this->runComponentsTests();
            $this->setResponse();
        }

        public function getResponse() {
            return $this->response;
        }
    // -- PUBLIC

    // PRIVATE
        private function includeAllTests() {
            $basePath = BASE_DIR.'/';
            foreach ($this->componentsToTest as $i => $componentTests) {
                $testsPath = COMPONENTS_FOLDERS.'/'.$componentTests['name'].'/tests/';

                $testGroupNames = array();
                foreach (new DirectoryIterator($basePath.$testsPath) as $file) {
                    if ($file->isFile()) {
                        $fileName = $file->getFilename();

                        if (preg_match('/Tests.php$/', $fileName)) {
                            $testGroupNames[] = str_replace('.php', '', $fileName);
                            include_once $testsPath.$fileName;
                        }
                    }
                }
                $this->componentsToTest[$i]['testGroupNames'] = $testGroupNames;
            }
        }

        private function runComponentsTests() {
            $this->componentsTests = array();

            foreach ($this->componentsToTest as $i => $componentTests) {
                $componentGroupsTester = new ComponentGroupsTester();

                foreach ($componentTests['testGroupNames'] as $testGroupName) {
                    $componentGroupsTester->addGroupTests(new $testGroupName());
                }
                $componentGroupsTester->run();

                $this->componentsToTest[$i]['groupsTester'] = $componentGroupsTester;
            }
        }

        private function setResponse() {
            $contentGroupsTests = '';
            $totalGreen = 0;
            $totalRed = 0;

            foreach ($this->componentsToTest as $componentTests) {
                $green = $componentTests['groupsTester']->green;
                $red = $componentTests['groupsTester']->red;

                $totalGreen += $green;
                $totalRed += $red;

                $content = '<div class="componentGroupsTestsTitle" onclick="componentGroupTestsToggle(this);">'.$componentTests['title'].'<small> '.($green + $red).' (<span class="w3-text-green">'.$green.'</span> / <span class="w3-text-red">'.$red.'</span>)</small> :</div>';
                $content .= $componentTests['groupsTester']->getResponse();

                $contentGroupsTests .= '<div class="componentGroupsTests">'.$content.'</div>';
            }
            $this->response = '<div class="allComponentGroupsTests" onclick="allComponentGroupsTestsToggle(this);">'.Language::getInstance()->component_tester_title.'<small> '.($totalGreen + $totalRed).' (<span class="w3-text-green">'.$totalGreen.'</span> / <span class="w3-text-red">'.$totalRed.'</span>)</small> :</div>';
            $this->response .= $contentGroupsTests;

            $this->response = '<div>'.$this->response.'</div>';
        }
    // -- PRIVATE

}

?>