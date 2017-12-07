/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved. 
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

function HtmlRenderForTag() {
    this.html;
    // this.position;
    this.parameters;
}

HtmlRenderForTag.prototype.render = function() {
    var self = this;

    var html = self.html;
    var extraHtml = html.replace(/\s\s+/g, ' ');
    var extraHtml = extraHtml.replace(/&gt;/g, '>').replace(/&lt;/g, '<').replace(/&amp;/g, '&');
        extraHtml = extraHtml.replace(/FOR\$/, '').replace(/\$FOR/, '').trim();
    var elements = extraHtml.split(' ');

    // PARAMETERS
        var parameterName = elements[0].trim();
            extraHtml = extraHtml.replace(parameterName + ' LIKE', '').trim();
            elements = extraHtml.split(' ');
    // -- PARAMETERS

    // TAG
        var tagName = elements[0].trim();
        extraHtml = extraHtml.replace(tagName, '').trim();

        // CONTAINER TAG & CONDITION CONTAINER TAG
            if (extraHtml.indexOf('INTO') != -1) {

                var conditionContainerTag = extraHtml.match(/(INTO)([\s\S]*)(\[([\s\S]*)\])$/);
                if (conditionContainerTag == null)
                    conditionContainerTag = extraHtml.match(/(INTO)([\s\S]*)$/);

                if (conditionContainerTag != null)
                    extraHtml = extraHtml.replace(conditionContainerTag[0], '').trim();

                elements = extraHtml.split(' ');
            }
        // -- CONTAINER TAG & CONDITION CONTAINER TAG

        // CONDITION TAG
            // var conditionTag = extraHtml.match(/\[(.*?)\]/);
            var conditionTag = extraHtml.match(/\[([\s\S]*)\]/);
            if (conditionTag != null)
                extraHtml = extraHtml.replace(conditionTag[0], '').trim();
        // -- CONDITION TAG
        elements = extraHtml.split(' ');
    // -- TAG

    var replaceWith = '';
    var parameter = self.parameters[parameterName];

    for (e in parameter) {
        var element = document.createElement(tagName);
            element.innerHTML = parameter[e];

        // CONDITION TAG
            if (conditionTag != null) {
                var condition = conditionTag[conditionTag.length -1].replace(/\$DATA/g, parameter[e]);
                var attributes = eval(condition);

                if (attributes != '') {
                    attributes = attributes.indexOf('*') !== -1 ? attributes.split('*') : [attributes];

                    for (x in attributes) {
                        if (attributes[x] != '') {
                            var attr = attributes[x].split('=');
                            element.setAttribute(attr[0], attr[1]);
                        }
                    }
                }
            }
        // -- CONDITION TAG

        replaceWith += element.outerHTML
    }

    // CONTAINER TAG
        if (conditionContainerTag != null) {
            var element = document.createElement(conditionContainerTag[2].trim());
                element.innerHTML = replaceWith;

            // CONDITION CONTAINER TAG
                if (conditionContainerTag.length > 4) {
                    var condition = conditionContainerTag[4].replace(/\$DATA/g, replaceWith);
                    var attributes = eval(condition);

                    if (attributes != '') {
                        attributes = attributes.indexOf('*') !== -1 ? attributes.split('*') : [attributes];

                        for (x in attributes) {
                            if (attributes[x] != '') {
                                var attr = attributes[x].split('=');
                                element.setAttribute(attr[0], attr[1]);
                            }
                        }
                    }
                }
            // -- CONDITION CONTAINER TAG

            replaceWith = element.outerHTML
        }
    // -- CONTAINER TAG

    return replaceWith;
}