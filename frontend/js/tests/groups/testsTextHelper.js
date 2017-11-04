

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
}