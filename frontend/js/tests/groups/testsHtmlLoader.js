// Tests Functions
    // functionHtmlLoader
        function functionHtmlLoader() {
            var request = new Request();
            request.url = ConfigJs.frontendHtmlUrl + '/test.html';
            request.callback = callbackHtmlLoader;
            request.callbackError = callbackHtmlLoaderError;
            request.send();
        }

        function callbackHtmlLoader(response) {
            var element = document.getElementById('containerHtmlLoader');
            element.innerHTML = response;
            dispatchRequestEndEvent(element, true);
        }

        function callbackHtmlLoaderError(response) {
            var element = document.getElementById('containerHtmlLoader');
            element.innerHTML = response;
            dispatchRequestEndEvent(element, false);
        }
    // -- functionHtmlLoader

    // functionHtmlLoaderLoad
        function functionHtmlLoaderLoad() {
            var testFile = new HtmlLoader();
                testFile.fileName = 'test';
                testFile.elementId = 'containerHtmlLoaderLoad';
                testFile.load();

            var element = document.getElementById(testFile.elementId);
            dispatchRequestEndEvent(element, true);
        }
    // -- functionHtmlLoaderLoad

    // functionHtmlLoaderLoadWithCallback
        function functionHtmlLoaderLoadWithCallback() {
            var testFile = new HtmlLoader();
                testFile.fileName = 'test';
                testFile.elementId = 'containerHtmlLoaderLoadWithCallback';
                testFile.callback = callbackHtmlLoaderLoadGetFirstChild;
                testFile.load();
        }

        function callbackHtmlLoaderLoadGetFirstChild() {
            var element = document.getElementById('containerHtmlLoaderLoadWithCallback');

            dispatchRequestEndEvent(element, element != undefined);
        }
    // -- functionHtmlLoaderLoadWithCallback
// -- Tests Functions

function testsHtmlLoader() {
    TestManager.group('HtmlLoader Tests');
    // TestManager.groupHidden();

    TestManager.test('HtmlLoader Request', functionHtmlLoader);
    TestManager.async('containerHtmlLoader');

    TestManager.test('HtmlLoader', functionHtmlLoaderLoad);
    TestManager.async('containerHtmlLoaderLoad');

    TestManager.test('HtmlLoader get First Child', functionHtmlLoaderLoadWithCallback);
    TestManager.async('containerHtmlLoaderLoadWithCallback');
}