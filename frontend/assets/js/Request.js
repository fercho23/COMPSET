/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved. 
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

// overrideMimeType

function Request() {
    this.url = '';
    this.method = 'POST';
    this.contentType = ConfigJs.requestContentType;
    this.acceptType = ConfigJs.requestAcceptType;
    this.callback = false;
    this.callbackError = false;

    var _parameters = {};
    var _asynchronous = true;
    var _xmlHttp = new XMLHttpRequest();

    function callFunction(fun, variables) {
        if (fun) {
            switch (typeof fun) {
                case 'function':
                    fun(variables);
                    break;
                case 'string':
                    if (typeof window[fun] === 'function')
                        window[fun](variables);
                    break;
            }
        }
    }

    Request.prototype.addParameter = function(key, value) {
        _parameters[key] = value;
    }

    Request.prototype.setAsynchronous = function(value) {
        _asynchronous = value === true ? true : false;
    }

    Request.prototype.send = function() {
        var self = this;

        function getDataToSend() {
            var params;
            switch (self.contentType.toLowerCase()) {
                case 'json':
                case 'application/json':
                    params = JSON.stringify(_parameters);
                    break;
                case 'xml':
                case 'application/xml':
                    params = '<root>';
                    for (var key in _parameters) {
                        params += '<' + key + '>' + _parameters[key] + '</' + key + '>';
                    }
                    params += '</root>';
                    break;
                default:
                    params = [];
                    for (var key in _parameters) {
                        params.push(key + '=' + _parameters[key]);
                    }
                    params = params.join('&');
                    break;
            }
            return params;
        }

        _xmlHttp.open(self.method, self.url, _asynchronous);
        _xmlHttp.setRequestHeader('Content-Type', self.contentType);
        _xmlHttp.setRequestHeader('Accept', self.acceptType);

        _xmlHttp.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    callFunction(self.callback, this.response);
                } else {
                    if (self.callbackError)
                        callFunction(self.callbackError, this.response);
                    else
                        console.error(this.status, this.response);
                }
            }
        };

        _xmlHttp.send(getDataToSend());
    }

}