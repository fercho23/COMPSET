/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved. 
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

// overrideMimeType

function Request() {
    this.url = '';
    this.method = 'GET';
    this.asynchronous = true;
    this.callback = false;
    this.callbackError = false;

    var _parameters = [];

    Request.prototype.addParameter = function(key, value) {
        _parameters[key] = value;
    }

    Request.prototype.setAsynchronous = function(value) {
        this.asynchronous = value === true ? true : false;
    }

    Request.prototype.send = function() {
        var self = this;

        function getParameters() {
            var par = [];
            for (var key in _parameters) {
                par.push(key + '=' + _parameters[key]);
            }
            return par.join('&');
        }

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

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open(self.method, self.url, self.asynchronous);
        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xmlHttp.onreadystatechange = function() {
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

        xmlHttp.send(getParameters());
    }

}