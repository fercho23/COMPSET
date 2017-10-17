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
    TestManager.container = 'container';
    testsRequest();
    testsTextHelper();
    TestManager.run();
// -- TestManager