/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

How to use TestManager for JavaScript:

1 - Create Group of Tests:
    First you need to create a Group of Tests, just pass it a name. All Tests you create after this are included.

    Examples:
        TestManager.group('Group Name Tests');


2 - Create Test:
    To add a Test in a Group, are some ways to do it.

    Examples:
        TestManager.test('Test Title', function);

        TestManager.test('Test Title', function() {
            var isTrue = true;
            return isTrue;
        });


3 - Assert Section:
    By Default all Tests AssertEquals their result with true.

    Examples:
        TestManager.like('AssertEquals', false);

        If you want to use other Assert, you must use like function with 2 parameters,
        first, name of Assert Class (String) and second, value to compare the result of function.

    Examples:
        TestManager.like('AssertEquals', 5);            => functionResult === 5

        TestManager.like('AssertLike', 'example text'); => functionResult == 'example text'

        TestManager.like('AssertNotEquals', false);     => functionResult !== false

        TestManager.like('AssertUnLike', true);         => functionResult != true


4- Async Results:
    Maybe you must wait a function, in that case use async function.
    You must pass the HTML element in which you add an Event with a Promise that must be fulfilled at any moment.

    Example:
        TestManager.async('containerRequest');

    To resolve the Promise must call a specific Event ('RequestEnd'):

        function callbackFunction(response) {
            var element = document.getElementById('containerRequest');
            element.innerHTML = response;
            dispatchRequestEndEvent(element, true);
        }

        function dispatchRequestEndEvent(element, detail) {
            var event = new CustomEvent('RequestEnd', {'detail': detail});
            element.dispatchEvent(event);
        }