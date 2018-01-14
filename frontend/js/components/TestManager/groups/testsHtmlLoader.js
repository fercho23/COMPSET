/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

// Tests Functions
    // functionHtmlLoader
        function functionHtmlLoader() {
            var request = new Request();
            request.url = ConfigJs.frontendHtmlUrl + '/test.html';
            request.callback = callbackHtmlLoader;
            request.callbackError = callbackHtmlLoaderError;
            request.send();
        }

        function callbackHtmlLoader(response) {
            var element = document.getElementById('containerHtmlLoader');
            element.innerHTML = response;
            dispatchRequestEndEvent(element, true);
        }

        function callbackHtmlLoaderError(response) {
            var element = document.getElementById('containerHtmlLoader');
            element.innerHTML = response;
            dispatchRequestEndEvent(element, false);
        }
    // -- functionHtmlLoader

    // functionHtmlLoaderLoad
        function functionHtmlLoaderLoad() {
            var element = document.getElementById('containerHtmlLoaderLoad');
            var htmlLoader = new HtmlLoader();
                htmlLoader.fileName = 'test';
                htmlLoader.container = element;
                htmlLoader.load();

            dispatchRequestEndEvent(element, true);
        }
    // -- functionHtmlLoaderLoad

    // functionHtmlLoaderLoadWithCallback
        function functionHtmlLoaderLoadWithCallback() {
            var element = document.getElementById('containerHtmlLoaderLoadWithCallback');
            var htmlLoader = new HtmlLoader();
                htmlLoader.fileName = 'test';
                htmlLoader.container = element;
                htmlLoader.callback = callbackHtmlLoaderLoadGetFirstChild;
                htmlLoader.load();
        }

        function callbackHtmlLoaderLoadGetFirstChild() {
            var element = document.getElementById('containerHtmlLoaderLoadWithCallback');
            dispatchRequestEndEvent(element, element != undefined);
        }
    // -- functionHtmlLoaderLoadWithCallback

    // functionHtmlLoaderRenderFunction
        function functionHtmlLoaderRenderFunction() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            var htmlLoader = new HtmlLoader();
                htmlLoader.fileName = 'testRender';
                htmlLoader.container = element;
                htmlLoader.callback = callbackHtmlLoaderLoadRenderFunction;
                htmlLoader.addParameter('names', ['Juan', 'Pedro', 'Pepe', 'Osvaldo']);
                htmlLoader.addParameter('surnames', ['De los Palotes', 'Pedron', 'Mujica', 'Perez']);
                htmlLoader.addParameter('ages', ['25', '1500', '78', '5']);
                htmlLoader.addParameter('phones', ['12456', '987654', '444555', '666666']);
                htmlLoader.render();
        }

        function callbackHtmlLoaderLoadRenderFunction() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            dispatchRequestEndEvent(element, true);
        }
    // -- functionHtmlLoaderRenderFunction

    // functionHtmlLoaderRenderDeleteTagFor
        function functionHtmlLoaderRenderDeleteTagFor() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            var html = element.innerHTML;
            return html.indexOf('$FOR') === -1 && html.indexOf('FOR$') === -1;
        }
    // -- functionHtmlLoaderRenderDeleteTagFor

    // functionHtmlLoaderRenderContainSpanTags
        function functionHtmlLoaderRenderContainSpanTags() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            var html = element.innerHTML;
            return html.indexOf('<span>') !== -1 && html.indexOf('</span>') !== -1;
        }
    // -- functionHtmlLoaderRenderContainSpanTags

    // functionHtmlLoaderRenderContainNames
        function functionHtmlLoaderRenderContainNames() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            var html = element.innerHTML;
            return html.indexOf('Juan') !== -1 && html.indexOf('Pedro') !== -1 && html.indexOf('Pepe') !== -1 && html.indexOf('Osvaldo') !== -1;
        }
    // -- functionHtmlLoaderRenderContainNames

    // functionHtmlLoaderRenderContainSurnames
        function functionHtmlLoaderRenderContainSurnames() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            var html = element.innerHTML;
            return html.indexOf('De los Palotes') !== -1 && html.indexOf('Pedron') !== -1 && html.indexOf('Mujica') !== -1 && html.indexOf('Perez') !== -1;
        }
    // -- functionHtmlLoaderRenderContainSurnames

    // functionHtmlLoaderRenderContainAgesSpanWithClasses
        function functionHtmlLoaderRenderContainAgesSpanWithClasses() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            var html = element.innerHTML;
            return html.indexOf('<span class="age ageNumber">25</span><span class="age ageNumber">1500</span><span class="age ageNumber">78</span><span class="age ageNumber">5</span>') !== -1;
        }
    // -- functionHtmlLoaderRenderContainAgesSpanWithClasses

    // functionHtmlLoaderRenderContainPhonesInDiv
        function functionHtmlLoaderRenderContainPhonesInDiv() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            var html = element.innerHTML;
            return html.indexOf('<div><span>12456</span><span>987654</span><span>444555</span><span>666666</span></div>') !== -1;
        }
    // -- functionHtmlLoaderRenderContainPhonesInDiv

    // functionHtmlLoaderRenderContainSmallerPhonesWithClassIntoDiv
        function functionHtmlLoaderRenderContainSmallerPhonesWithClassIntoDiv() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            var html = element.innerHTML;
            return html.indexOf('<span class="litle">12456</span><span>987654</span><span class="litle">444555</span><span>666666</span>') !== -1;
        }
    // -- functionHtmlLoaderRenderContainSmallerPhonesWithClassIntoDiv

    // functionHtmlLoaderRenderContainSurnamesSpanIntoDivWithClassesAndStyle
        function functionHtmlLoaderRenderContainSurnamesSpanIntoDivWithClassesAndStyle() {
            var element = document.getElementById('containerHtmlLoaderRenderFunction');
            var html = element.innerHTML;
            return html.indexOf('<div class="superDiv" style="font-weight:600;"><span>De los Palotes</span><span>Pedron</span><span>Mujica</span><span>Perez</span></div>') !== -1;
        }
    // -- functionHtmlLoaderRenderContainSurnamesSpanIntoDivWithClassesAndStyle
// -- Tests Functions

function testsHtmlLoader() {
    TestManager.group('HtmlLoader Tests');
    // TestManager.groupHidden();

    TestManager.test('HtmlLoader Request', functionHtmlLoader);
    TestManager.async('containerHtmlLoader');

    TestManager.test('HtmlLoader', functionHtmlLoaderLoad);
    TestManager.async('containerHtmlLoaderLoad');

    TestManager.test('Get First Child', functionHtmlLoaderLoadWithCallback);
    TestManager.async('containerHtmlLoaderLoadWithCallback');

    TestManager.test('Render Function', functionHtmlLoaderRenderFunction);
    TestManager.async('containerHtmlLoaderRenderFunction');

    TestManager.test('Render Delete Tag "For"', functionHtmlLoaderRenderDeleteTagFor);

    TestManager.test('Render Contains "Span" Tags', functionHtmlLoaderRenderContainSpanTags);

    TestManager.test('Render Contains Names', functionHtmlLoaderRenderContainNames);

    TestManager.test('Render Contains Surnames', functionHtmlLoaderRenderContainSurnames);

    TestManager.test('Render Contains Ages Span With Classes', functionHtmlLoaderRenderContainAgesSpanWithClasses);
 
    TestManager.test('Render Contains Phones Like Span In div', functionHtmlLoaderRenderContainPhonesInDiv);

    TestManager.test('Render Contains Smaller (Than 666666) Phones Like Span With Class Into Div', functionHtmlLoaderRenderContainSmallerPhonesWithClassIntoDiv);

    TestManager.test('Render Contains Surnames Like Span Into Div With Classes And Style', functionHtmlLoaderRenderContainSurnamesSpanIntoDivWithClassesAndStyle);
}