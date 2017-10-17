/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved. 
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

var TextHelper = new function() {
// function TextHelper(value) {
    this.value;

    this.replace = function(params) {
        if (params.length) {
            for (var i = 0; i < params.length; i++) {
                // console.log(value, i, params[i]);
                //value = value.replace('{' + i + '}', params[i]);

                 regex = new RegExp('\\{' + i + '\\}', 'g');
                // console.log(value, i, regex, params[i]);
                 this.value = this.value.replace(regex, params[i]);

                // console.log(value, i, params[i]);
                // value = value.replace(new RegExp('{' + i + '}'), params[i]);
            }
        }

        return this.value;
    }

}
