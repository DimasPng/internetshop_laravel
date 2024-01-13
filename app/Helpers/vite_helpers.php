<?php
// app/Helpers/vite_helpers.php
function vite_asset($path) {
    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
    return isset($manifest[$path]) ? '/build/'.$manifest[$path]['file'] : '';
}

