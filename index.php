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
    <title>SeaBreeze FrameWork</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="frontend/css/vendors/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="frontend/css/vendors/font-awesome.min.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />


</head>
<body>
    <div id="container"></div>

    <script type="text/javascript" src="frontend/js/components/JsLoader/JsLoader.js"></script>
    <script type="text/javascript" src="frontend/js/ConfigJs.js"></script>
    <script>
        ConfigJs.language = '<?php echo $language; ?>';
    </script>
    <script type="text/javascript" src="frontend/js/application.js"></script>

<!--
    <script type="text/javascript" src="frontend/js/components/ConfigJs.js"></script>
    <script type="text/javascript" src="frontend/js/components/language/<?php echo $language; ?>.js"></script>
    <script>
        ConfigJs.language = '<?php echo $language; ?>';
    </script>
    <script type="text/javascript" src="frontend/js/components/Request.js"></script>
    <script type="text/javascript" src="frontend/js/components/TextHelper.js"></script>
    <script type="text/javascript" src="frontend/js/components/HtmlLoader.js"></script>
-->

    <!-- BOOTSTRAP-NATIVE -->
        <!-- V3 version -->
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/2.0.15/bootstrap-native.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap.native@2.0.15/dist/bootstrap-native.min.js"></script> -->
        <!-- <script type="text/javascript" src="frontend/js/bootstrap-native.min.js"></script> -->
        <!-- V4 version -->
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/2.0.15/bootstrap-native-v4.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap.native@2.0.15/dist/bootstrap-native-v4.min.js"></script> -->
        <!-- <script type="text/javascript" src="frontend/js/bootstrap-native-v4.min.js"></script> -->
    <!-- -- BOOTSTRAP-NATIVE -->
</body>
</html>
