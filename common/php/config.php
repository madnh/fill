<?php
require_once 'bootstrap.php';

$config = json_decode(file_get_contents(COMMON_DIR . DS . 'default_config.json'), true);

foreach ($config['file'] as $fileType => $fileName) {
    if (!file_exists($fileName)) {
        sayError(new Exception('File type "' . $fileType . '" not found'));
    }
}

if (isset($argv[1])) {
    $project = $argv[1];
    define('PROJECT_NAME', $project);
    define('PROJECT_DIR', BASE_DIR . DS . $project);
} else {
    define('PROJECT_DIR', getcwd());
    $project = basename(PROJECT_DIR);
    define('PROJECT_NAME', $project);
}

$projectConfigFile = PROJECT_DIR . DS . 'config.json';
if (file_exists($projectConfigFile)) {
    $projectConfig = json_decode(file_get_contents($projectConfigFile), true);

    if (!is_array($projectConfig)) {
        sayError(new Exception("Project's config is corrupt"));
    }

    $config = array_merge($config, $projectConfig);
}

return $config;