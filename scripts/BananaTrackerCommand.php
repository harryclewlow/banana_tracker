<?php

require_once '../helpers/BananaTrackerHelper.php';

if (empty($route = $argv[1])) {
    die('No route given');
}

$bananaTracker = new BananaTrackerHelper();

try {
    $sortedRoute = $bananaTracker->getSortedRoute($route);
} catch (Exception $exception) {
    die($exception->getMessage());
}

echo '-------------';
echo "\r\n";
echo 'Ordered Route';
echo "\r\n";
echo '-------------';
echo "\r\n";

foreach ($sortedRoute as $key => $stop) {
    echo sprintf('%s: %s', $key + 1, $stop);
    echo "\r\n";
}

echo '-------------';
