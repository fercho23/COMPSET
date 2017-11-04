/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved. 
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

var JsLoader = (function() {

   return {
        load: function(jsFilePath) {
            document.write('<script type="text/javascript" src="' + jsFilePath + '"></script>');
        }
    }

})();