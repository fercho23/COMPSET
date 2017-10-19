<?php
    $language = NULL;
    if (isset($_GET['language'])) {
        $language = $_GET['language'];
    }
    if ($language == NULL) {
        $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>SeaBreeze FrameWork Test</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="frontend/assets/css/w3.css"/>
    <link rel="stylesheet" type="text/css" href="frontend/assets/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="frontend/assets/css/TestManager.css"/>

</head>
<body>
    <div id="container"></div>

    <script type="text/javascript" src="frontend/assets/js/ConfigJs.js"></script>
    <script type="text/javascript" src="frontend/assets/js/language/<?php echo $language; ?>.js"></script>
    <script type="text/javascript" src="frontend/assets/js/TextHelper.js"></script>
    <script>
        ConfigJs.language = '<?php echo $language; ?>';
    </script>
    <script type="text/javascript" src="frontend/assets/js/Request.js"></script>


    <script type="text/javascript" src="frontend/assets/js/tests/TestManager.js"></script>
    <!-- ASSERTS -->
        <script src="frontend/assets/js/tests/asserts/AssertEquals.js"></script>
        <script src="frontend/assets/js/tests/asserts/AssertNotEquals.js"></script>
        <script src="frontend/assets/js/tests/asserts/AssertLike.js"></script>
        <script src="frontend/assets/js/tests/asserts/AssertUnLike.js"></script>
    <!-- -- ASSERTS -->

    <!-- GROUP TESTS -->
        <script type="text/javascript" src="frontend/assets/js/tests/testsRequest.js"></script>
        <script type="text/javascript" src="frontend/assets/js/tests/testsTextHelper.js"></script>
    <!-- -- GROUP TESTS -->

    <script type="text/javascript" src="frontend/assets/js/tests/tests.js"></script>
</body>
</html>
