<?php
$routes = [
    'metadata',
    'getScreenshot'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

