<?php
function getAssetPath($path) {
    // Check if script is in subdirectory
    $isSubdir = strpos($_SERVER['SCRIPT_NAME'], '/blog/') !== false;
    return $isSubdir ? "../$path" : $path;
}
?>