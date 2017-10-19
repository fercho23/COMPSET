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
    <link rel="stylesheet" type="text/css" href="frontend/assets/css/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" /> -->

</head>
<body>
    <div id="container"></div>

    <script type="text/javascript" src="frontend/assets/js/ConfigJs.js"></script>
    <script type="text/javascript" src="frontend/assets/js/language/<?php echo $language; ?>.js"></script>
    <script>
        ConfigJs.language = '<?php echo $language; ?>';
    </script>
    <script type="text/javascript" src="frontend/assets/js/Request.js"></script>
    <script type="text/javascript" src="frontend/assets/js/TextHelper.js"></script>

    <!-- BOOTSTRAP-NATIVE -->
        <!-- V3 version -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/2.0.15/bootstrap-native.min.js"></script>
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap.native@2.0.15/dist/bootstrap-native.min.js"></script> -->
        <!-- <script type="text/javascript" src="frontend/assets/js/bootstrap-native.min.js"></script> -->
        <!-- V4 version -->
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/2.0.15/bootstrap-native-v4.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap.native@2.0.15/dist/bootstrap-native-v4.min.js"></script> -->
        <!-- <script type="text/javascript" src="frontend/assets/js/bootstrap-native-v4.min.js"></script> -->
    <!-- -- BOOTSTRAP-NATIVE -->
</body>
</html>
