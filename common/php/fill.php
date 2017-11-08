<?php
require 'bootstrap.php';

$config = require 'config.php';

file_put_contents(PROJECT_DIR.DS.$config['output_file'], '');

$profiles = json_decode(file_get_contents($project.DS.$config['profile_file']), true);
$templateItem = file_get_contents($project.DS.$config['template_file']);
$template = [];

foreach ($profiles as $index => $profile) {
    $tmpTemplate = $templateItem;
    $data = $profile;
    $data['_index_base_1'] = $index + 1;
    $data['_index'] = $index;

    foreach ($data as $name => $value) {
        $search = $config['template_profile_prefix'] . strtoupper($name);

        $tmpTemplate = str_replace($search, $value, $tmpTemplate);
    }


    $template[] = $tmpTemplate;
}

$output = implode($config['profile_separate'], $template);

$wrapperContent = file_get_contents(PROJECT_DIR.DS.$config['wrapper_file']);
if(!empty($wrapperContent)){
    $output = str_replace('CONTENT_HERE', $output, $wrapperContent);
}

file_put_contents(PROJECT_DIR.DS.$config['output_file'], $output);
