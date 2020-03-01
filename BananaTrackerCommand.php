<?php

require_once 'BananaTrackerHelper.php';

if (empty($route = $argv[1])) {
    die('No route given');
}

$bananaTracker = new BananaTrackerHelper();

try {
    $sortedRoute = $bananaTracker->getSortedRoute($route);
} catch (Exception $exception) {
    die('Invalid Json Route');
}

foreach ($sortedRoute as $stop) {
    echo $stop;
    echo "\r\n";
}
