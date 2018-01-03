// PHP TESTS
    // TOGGLE FUNCTIONS
        function allComponentGroupsTestsToggle(element) {
            var elements = element.parentElement.getElementsByClassName('componentGroupsTests');
            for (i in elements) {
                elements[i].classList.toggle('hide');
            }
        }

        function componentGroupTestsToggle(element) {
            var elements = element.parentElement.getElementsByClassName('groupTests');
            for (i in elements) {
                elements[i].classList.toggle('hide');
            }
        }

        function groupTestsToggle(element) {
            var elements = element.parentElement.getElementsByClassName('groupTestsList');
            for (i in elements) {
                elements[i].classList.toggle('hide');
            }
        }
    // -- TOGGLE FUNCTIONS
// -- PHP TESTS