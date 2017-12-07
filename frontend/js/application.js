
// JsLoader
    JsLoader.load(ConfigJs.frontendJsUrl + '/toRefactoring/toRefactoring.js');
    JsLoader.load(ConfigJs.frontendJsComponentUrl + '/language/' + ConfigJs.language + '.js');
    JsLoader.loadComponent('Request');
    JsLoader.loadComponent('TextHelper');
    JsLoader.loadComponent('HtmlLoader');
    JsLoader.load('https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/2.0.15/bootstrap-native.min.js');
// -- JsLoader