    function getIndices(haystack, needle) {
        var returns = [];
        var position = 0;
        while (haystack.indexOf(needle, position) > -1) {
            var index = haystack.indexOf(needle, position);
            returns.push(index);
            position = index + needle.length;
        }
        return returns;
    }