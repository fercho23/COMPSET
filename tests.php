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

    <link rel="stylesheet" type="text/css" href="frontend/css/vendors/w3.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="frontend/css/vendors/font-awesome.min.css"/> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="frontend/css/TestManager.css"/>

</head>
<body>
    <div id="container"></div>

    <script type="text/javascript" src="frontend/js/components/JsLoader.js"></script>
    <script type="text/javascript" src="frontend/js/ConfigJs.js"></script>
    <script>
        ConfigJs.language = '<?php echo $language; ?>';
    </script>
    <script type="text/javascript" src="frontend/js/application.test.js"></script>
<!--
-->


<!--
    <script type="text/javascript" src="frontend/js/ConfigJs.js"></script>
    <script type="text/javascript" src="frontend/js/components/language/<?php echo $language; ?>.js"></script>
    <script>
        ConfigJs.language = '<?php echo $language; ?>';
    </script>
    <script type="text/javascript" src="frontend/js/components/Request.js"></script>
    <script type="text/javascript" src="frontend/js/components/TextHelper.js"></script>
    <script type="text/javascript" src="frontend/js/components/HtmlLoader.js"></script>

    <script type="text/javascript" src="frontend/js/tests/TestManager.js"></script>
        <script src="frontend/js/tests/asserts/AssertEquals.js"></script>
        <script src="frontend/js/tests/asserts/AssertNotEquals.js"></script>
        <script src="frontend/js/tests/asserts/AssertLike.js"></script>
        <script src="frontend/js/tests/asserts/AssertUnLike.js"></script>

        <script type="text/javascript" src="frontend/js/tests/testsRequest.js"></script>
        <script type="text/javascript" src="frontend/js/tests/testsTextHelper.js"></script>
        <script type="text/javascript" src="frontend/js/tests/testsHtmlLoader.js"></script>
    <script type="text/javascript" src="frontend/js/tests/tests.js"></script>
-->
</body>
</html>
