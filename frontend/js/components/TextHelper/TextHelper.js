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
                 regex = new RegExp('\\{' + i + '\\}', 'g');
                 this.value = this.value.replace(regex, params[i]);
            }
        }

        return this.value;
    }

}
