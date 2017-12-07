/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved. 
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

JsLoader.load(ConfigJs.frontendJsComponentUrl + '/HtmlLoader/HtmlRender.js');

function HtmlLoader() {
    this.fileName;
    this.callback = false;
    this.callbackError = false;
    this.container;

    this.__parameters = [];
}

HtmlLoader.prototype.load = function() {
    var self = this;

    function callbackHtmlLoader(response) {
        self.container.innerHTML = response;
        if (self.callback)
            self.callback();
        else
            dispatchRequestEndEvent(self.container, true);
    }

    function callbackHtmlLoaderError(response) {
        self.container.innerHTML = response;
        if (self.callbackError)
            self.callbackError();
        else
            dispatchRequestEndEvent(self.container, false);
    }

    var request = new Request();
        // request.method = ConfigJs.methodGet;
        request.url = ConfigJs.frontendHtmlUrl + '/' + self.fileName + '.html';
        request.contentType = ConfigJs.mimeTypeHtml;
        request.acceptType = ConfigJs.mimeTypeHtml;
        request.callback = callbackHtmlLoader;
        request.callbackError = callbackHtmlLoaderError;
        request.send();
}

HtmlLoader.prototype.render = function() {
    var self = this;

    var callback = self.callback;
    var callbackError = self.callbackError;

    // FUNCTIONS
        function callbackRenderHtml() {
            var htmlRender = new HtmlRender();
                htmlRender.parameters = self.__parameters;
                htmlRender.html = self.container.innerHTML;

            self.container.innerHTML = htmlRender.render();
        }

        function callbackHtmlLoaderRender() {
            callbackRenderHtml();
            if (callback)
                callback();
        }

        function callbackErrorHtmlLoaderRender() {
            callbackRenderHtml();
            if (callbackError)
                callbackError();
        }
    // -- FUNCTIONS

    self.callback = callbackHtmlLoaderRender;
    self.callbackError = callbackErrorHtmlLoaderRender;
    self.load();
}

HtmlLoader.prototype.addParameter = function(key, value) {
    this.__parameters[key] = value;
}
