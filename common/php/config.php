<?php
require_once 'bootstrap.php';

$config = json_decode(file_get_contents(COMMON_DIR.DS.'default_config.json'), true);

$project = 'Sample';
if(isset($argv[1])){
    $project = $argv[1];
}

define('PROJECT_DIR', BASE_DIR.DS.$project);

$projectConfigFile = PROJECT_DIR . DS . 'config.json';
if(file_exists($projectConfigFile)){
    $projectConfig = json_decode(file_get_contents($projectConfigFile), true);

    if(!is_array($projectConfig)){
        throw new Exception("Project's config is corrupt");
    }

    $config = array_merge($config, $projectConfig);
}

return $config;