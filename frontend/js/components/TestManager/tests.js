/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

// PHP TESTS
    // CALL TESTS
        function functionPhpTests() {
            var request = new Request();
                request.url = 'backend/tests.php';
                // request.contentType = ConfigJs.mimeTypeHtml;
                request.acceptType = ConfigJs.mimeTypeHtml;
                request.callback = callbackFunctionPhpTests;
                request.callbackError = callbackFunctionPhpTestsError;
                request.send();
        }

        function callbackFunctionPhpTests(response) {
            var element = document.getElementById('containerTestPhp');
            element.innerHTML = response;
            dispatchRequestEndEvent(element, true);
        }

        function callbackFunctionPhpTestsError(response) {
            var element = document.getElementById('containerTestPhp');
            element.innerHTML = response;
            dispatchRequestEndEvent(element, false);
        }

        functionPhpTests();
    // -- CALL TESTS
// -- PHP TESTS

// Helper Functions
    function dispatchRequestEndEvent(element, detail) {
        var event = new CustomEvent('RequestEnd', {'detail': detail});
        element.dispatchEvent(event);
    }

    function addUserIdenfifierInRequest(request) {
        if (request instanceof Request) {
            request.addParameter('user', ConfigJs.user);
            request.addParameter('password', ConfigJs.password);
            request.addParameter('language', ConfigJs.language);
            // request.addParameter('UserIdentifier', '{"name": "' + ConfigJs.name + '", \
            //                                          "password": "' + ConfigJs.password + '", \
            //                                          "language": "' + ConfigJs.language + '" \
            //                                      }');
        }
    }
// -- Helper Functions

// TestManager
    TestManager.container = 'containerTestManager';
    testsTextHelper();
    testsHtmlLoader();
    testsRequest();
    TestManager.run();
// -- TestManager