<?php
$project = 'Sample';
if(isset($argv[1])){
    $project = $argv[1];
}

file_put_contents($project.DIRECTORY_SEPARATOR.'3. Output.html', '');

$profiles = json_decode(file_get_contents($project.DIRECTORY_SEPARATOR.'0. Profiles.json'), true);
$templateItem = file_get_contents($project.DIRECTORY_SEPARATOR.'1. Template.html');
$template = [];

foreach ($profiles as $index => $profile) {
    $tmpTemplate = $templateItem;
    $data = $profile;
    $data['_index_base_1'] = $index + 1;
    $data['_index'] = $index;

    foreach ($data as $name => $value) {
        $search = 'PROFILE__' . strtoupper($name);

        $tmpTemplate = str_replace($search, $value, $tmpTemplate);
    }


    $template[] = "\n".$tmpTemplate;
}

$output = implode("\n\n", $template);

$wrapperContent = file_get_contents($project.DIRECTORY_SEPARATOR.'2. Wrapper.html');
if(!empty($wrapperContent)){
    $output = str_replace('CONTENT_HERE', $output, $wrapperContent);
}

file_put_contents($project.DIRECTORY_SEPARATOR.'3. Output.html', $output);
