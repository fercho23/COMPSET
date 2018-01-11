/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

// JsLoader
    JsLoader.load(ConfigJs.frontendJsUrl + '/toRefactoring/toRefactoring.js');
    JsLoader.load(ConfigJs.frontendJsComponentUrl + '/language/' + ConfigJs.language + '.js');
    JsLoader.loadComponent('Request');
    JsLoader.loadComponent('TextHelper');
    JsLoader.loadComponent('HtmlLoader');
    JsLoader.load('https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/2.0.15/bootstrap-native.min.js');
// -- JsLoader