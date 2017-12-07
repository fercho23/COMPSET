
// JsLoader
    JsLoader.load(ConfigJs.frontendJsUrl + '/toRefactoring/toRefactoring.js');
    JsLoader.load(ConfigJs.frontendJsComponentUrl + '/language/' + ConfigJs.language + '.js');
    JsLoader.loadComponent('Request');
    JsLoader.loadComponent('TextHelper');
    JsLoader.loadComponent('HtmlLoader');

    JsLoader.load(ConfigJs.frontendJsTestsUrl + '/TestManager.js');
    JsLoader.load(ConfigJs.frontendJsTestsGroupsUrl + '/testsRequest.js');
    JsLoader.load(ConfigJs.frontendJsTestsGroupsUrl + '/testsTextHelper.js');
    JsLoader.load(ConfigJs.frontendJsTestsGroupsUrl + '/testsHtmlLoader.js');
    JsLoader.load(ConfigJs.frontendJsTestsUrl + '/tests.js');
// -- JsLoader