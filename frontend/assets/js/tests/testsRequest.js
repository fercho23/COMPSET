// Tests Functions
    // functionRequest
        function functionRequest() {
            var request = new Request();
            request.url = ConfigJs.backendMainUrl;
            request.method = 'POST';
            request.callback = callbackFunction;
            request.callbackError = callbackFunctionError;
            addUserIdenfifierInRequest(request);
            request.addParameter('action', 'tests');
            request.send();
        }

        function callbackFunction(response) {
            var element = document.getElementById('containerRequest');
            element.innerHTML = response;
            dispatchRequestEndEvent(element, true);
        }

        function callbackFunctionError(response) {
            var element = document.getElementById('containerRequest');
            element.innerHTML = response;
            dispatchRequestEndEvent(element, false);
        }
    // -- functionRequest
// -- Tests Functions

    function testsRequest(){
        TestManager.group('Basic Application Tests');
        // TestManager.groupHidden();

        TestManager.test('Request', functionRequest);
        TestManager.async('containerRequest');
    }