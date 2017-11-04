/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

// ASSERTS
    JsLoader.load(ConfigJs.frontendJsTestsUrl + '/asserts/AssertEquals.js');
    JsLoader.load(ConfigJs.frontendJsTestsUrl + '/asserts/AssertNotEquals.js');
    JsLoader.load(ConfigJs.frontendJsTestsUrl + '/asserts/AssertLike.js');
    JsLoader.load(ConfigJs.frontendJsTestsUrl + '/asserts/AssertUnLike.js');
// -- ASSERTS

var TestManager = (function() {
    var _singleInstance;
    var _groups = [];
    var _actualGroupTitle = '';

    var _greens = 0;
    var _reds = 0;

    this.container = 'TestManager';

    function getActualGroup() {
        return _groups[_actualGroupTitle];
    }

    function getActualGroupTests() {
        return getActualGroup()['tests'];
    }

    function getLastTestInActualGroupTest() {
        return getActualGroupTests()[getActualGroupTests().length - 1];
    }

    function getAssertResultByTest(test, value) {
        var assertValue = ('assert' in test ? test['assert'] : new AssertEquals(true)).assert(value);
        if (assertValue === true)
            _greens ++;
        else
            _reds ++;
        return assertValue;
    }

    async function getValueByTest(test) {
        var value = undefined;
        fun = test['function'];
        if ('async' in test) {
            'arguments' in test ? fun.apply(this, test['arguments']) : fun();
            await test['async'].then(function(val) {
                value = val;
            });
        } else {
            value = 'arguments' in test ? fun.apply(this, test['arguments']) : fun();
        }
        return value;
    }

    function getGreenRedAmount(green, red) {
        return (green + red) + ' (<span class="w3-text-green">' + green + '</span>/<span class="w3-text-red">' + red + '</span>)';
    }

    function getTimeMeasure(end, start) {
        var total = end - start;
        var text = '';
        if (total > 1)
            text += '<small><i> (' + (total) + ' ms)</i></small>';
        return text;
    }

   return {
        like: function(className, value) {
            getLastTestInActualGroupTest()['assert'] = new className(value);
        },

        group: function(title) {
            _actualGroupTitle = title;
            if (!(_actualGroupTitle in _groups)) {
                _groups[_actualGroupTitle] = [];
                getActualGroup()['tests'] = [];
            }
        },

        groupHidden: function() {
            getActualGroup()['hidden'] = true;
        },

        test: function(title, fun) {
            var test = [];
            test['title'] = title;
            test['function'] = fun;

            getActualGroupTests().push(test);
        },

        withParameters: function(arg) {
            getLastTestInActualGroupTest()['arguments'] = arguments;
        },

        async: function(elementId) {
            var element = document.getElementById(elementId);
            if (element === null) {
                element = document.createElement('div');
                element.id = elementId;
                getLastTestInActualGroupTest()['asyncElement'] = element;
            }

            var promise = new Promise(function(resolve) {
                element.addEventListener('RequestEnd', function (e) {
                    resolve(e.detail);
                });
            });

            getLastTestInActualGroupTest()['async'] = promise;
        },

        run: async function() {
            var containerArea = document.getElementById(this.container);
            var totalGreen = 0;
            var totalred = 0;

            var divTestManager = document.createElement('div');
                divTestManager.id = 'TestManager';
                divTestManager.className = 'TestManager';
            containerArea.appendChild(divTestManager);

            var divTestManagerSupport = document.createElement('div');
                divTestManagerSupport.id = 'TestManagerSupport';
                divTestManagerSupport.className = 'TestManagerSupport';
            containerArea.appendChild(divTestManagerSupport);

            var divTitle = document.createElement('div');
                divTitle.className = 'testsTitle';
                divTitle.innerHTML = Language.test_test_in_progress + ' ' + spin + getGreenRedAmount(totalGreen , totalred);
                divTestManager.appendChild(divTitle);

            var spin = '<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>';
            for (y in _groups) {
                var group = _groups[y];
                var tests = group['tests'];
                _greens = 0;
                _reds = 0;

                // VISUAL
                    var divTestGroup = document.createElement('div');
                        divTestGroup.className = 'testGroup';
                    var titleTestGroup = document.createElement('div');
                        titleTestGroup.className = 'testGroupTitle';
                        titleTestGroup.onclick = function() {
                            this.parentElement.querySelector('.testGroupList').classList.toggle('hidden');
                        };
                        titleTestGroup.innerHTML = y;
                    var smallTitleTestGroup = document.createElement('small');
                        smallTitleTestGroup.className = 'testGroupTitleSmall';
                        smallTitleTestGroup.innerHTML = ' ...' + spin;

                    var listTestGroup = document.createElement('ol');
                        listTestGroup.className = 'testGroupList';
                        divTestGroup.appendChild(titleTestGroup);
                        divTestGroup.appendChild(smallTitleTestGroup);
                        divTestGroup.appendChild(listTestGroup);

                    divTestManager.appendChild(divTestGroup);
                    if ('hidden' in group)
                        titleTestGroup.onclick();
                // -- VISUAL

                for (x in tests) {
                    var start = performance.now();
                    var test = tests[x];

                    if ('asyncElement' in test)
                        divTestManagerSupport.appendChild(test['asyncElement']);

                    var liTest = document.createElement('li');
                        liTest.className = 'w3-text-deep-orange';
                        liTest.innerHTML = test['title'] + ' ...' ;
                    listTestGroup.appendChild(liTest);

                    var value = await getValueByTest(test);
                    var assertResult = getAssertResultByTest(test, value);

                    var end = performance.now();
                    liTest.innerHTML = test['title'] + '.' + getTimeMeasure(end, start) + (assertResult === true ? '' : '<br><strong> ' + assertResult + '</strong>');
                    liTest.className = 'w3-text-' + (assertResult === true ? 'green' : 'red');
                    smallTitleTestGroup.innerHTML = spin + getGreenRedAmount(_greens , _reds);
                    divTitle.innerHTML = Language.test_test_in_progress + ' ' + spin + getGreenRedAmount(totalGreen + _greens , totalred + _reds);
                }
                totalGreen += _greens;
                totalred += _reds;
                smallTitleTestGroup.innerHTML = getGreenRedAmount(_greens , _reds);
            }

            divTitle.innerHTML = Language.test_total_test + ' ' + getGreenRedAmount(totalGreen , totalred);
        }

    }

})();