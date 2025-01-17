<?php
function getAssetPath($path) {
    // Check if script is in subdirectory
    $isSubdir = strpos($_SERVER['SCRIPT_NAME'], '/pages/') !== false;
    return $isSubdir ? "../$path" : $path;
}
?>