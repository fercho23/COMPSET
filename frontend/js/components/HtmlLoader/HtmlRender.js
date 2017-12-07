/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved. 
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

// TAGS
    JsLoader.load(ConfigJs.frontendJsComponentUrl + '/HtmlLoader/HtmlRenderForTag.js');
// -- TAGS

function HtmlRender() {
    this.parameters = [];
    this.html;
}

HtmlRender.prototype.render = function() {
    var self = this;

    function replaceTagFor(html) {
        var forTag = new HtmlRenderForTag();
            forTag.html = html;
            forTag.parameters = self.parameters;
        return forTag.render();
    }

    var html = self.html;

    var tagMatches = html.match(/\$FOR[\s\S]*?FOR\$/g);
        tagMatches.reverse();

    for (var i in tagMatches) {
        var htmlToRender = tagMatches[i];
        var replaceWith = replaceTagFor(htmlToRender);

        html = html.replace(htmlToRender, replaceWith);
    }

    return html;
}