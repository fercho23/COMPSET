/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved. 
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

function HtmlLoader() {
    this.fileName;
    this.callback = false;
    this.callbackError = false;
    this.elementId;
}

HtmlLoader.prototype.load = function() {
    var self = this;
    var element = document.getElementById(self.elementId);

    function callbackHtmlLoader(response) {
        element.innerHTML += response;
        if (self.callback) {
            self.callback();
        } else {
            dispatchRequestEndEvent(element, true);
        }
    }

    function callbackHtmlLoaderError(response) {
        element.innerHTML += response;
        if (self.callbackError) {
            self.callbackError();
        } else {
            dispatchRequestEndEvent(element, false);
        }
    }

    var request = new Request();
        request.method = ConfigJs.methodGet;
        request.url = ConfigJs.frontendHtmlUrl + '/' + self.fileName + '.html';
        request.contentType = ConfigJs.mimeTypeHtml;
        request.acceptType = ConfigJs.mimeTypeHtml;
        request.callback = callbackHtmlLoader;
        request.callbackError = callbackHtmlLoaderError;
        request.send();
}
