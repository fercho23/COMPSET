/**
* Copyright (c) 2017 Fernando Ariel Mateos <fernandoarielmateos@gmail.com>. All rights reserved.
* Released under the MIT license
* https://opensource.org/licenses/MIT
**/

// Tests Functions
    function functionTextHelperWithParamters(word) {
        return 'Hola' === word;
    }

    function functionTextHelperWithManyParamters(word, secondWord) {
        return 'Hola Chau' === word + ' ' + secondWord;
    }
// -- Tests Functions

function testsTextHelper() {
    TestManager.group('TextHelper Tests');
    TestManager.groupHidden();

    TestManager.test('Text replace 1', function() {
        TextHelper.value = 'Test {0}';
        var result = TextHelper.replace(['First']);
        return result === 'Test First';
    });

    TestManager.test('Text replace 2', function() {
        TextHelper.value = 'Test {0} {1}';
        var result = TextHelper.replace(['First', 'Second']);
        return result === 'Test First Second';
    });

    TestManager.test('Text replace 2 same text', function() {
        TextHelper.value = 'Test {0} {0}';
        var result = TextHelper.replace(['First', 'Second']);
        return result === 'Test First First';
    });

    TestManager.test('Text Exmple with Paramters', functionTextHelperWithParamters);
    TestManager.withParameters('Hola');

    TestManager.test('Text Exmple with many Paramters', functionTextHelperWithManyParamters);
    TestManager.withParameters('Hola', 'Chau');
}