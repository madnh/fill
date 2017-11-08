<?php
$projectName = $argv[1];
$profiles = [];

$rawContentFilePath = $projectName . DIRECTORY_SEPARATOR . '_Raw.txt';
$content = file_get_contents($rawContentFilePath);


// Apply logic to extract profiles here


$profilesJSON = json_encode($profiles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents($projectName . DIRECTORY_SEPARATOR . '1. Profiles.json', $profilesJSON);
