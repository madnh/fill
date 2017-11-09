<?php
require 'bootstrap.php';

$config = require 'config.php';
$cli = CLI::getInstance();
$stepIndex = 1;

newLine();
sayInfo('Project: ' . textColor(PROJECT_NAME, 'yellow'));
newLine(2);

sayInline($stepIndex++ . '. Clear old output ');
file_put_contents(PROJECT_DIR . DS . $config['file']['output'], '');

sayInfo(symbol('check'));

$filler = new Filler($config);
newLine();

// Get filled content of profiles
say($stepIndex++ . '. Fill profiles to template ');

$filler->setFiller($config['filler']['profile']);
$filler->setTemplateFile(PROJECT_DIR . DS . $config['file']['template']);

$filledProfiles = [];
$profiles = json_decode(file_get_contents(PROJECT_DIR . DS . $config['file']['profile']), true);

foreach ($profiles as $index => $profile) {
    $data = $profile;
    $data['_index_base_1'] = $index + 1;
    $data['_index'] = $index;

    sayInline("   - Profile " . $index . ' ');

    try {
        $filledProfiles[] = $filler->fill($data);

        sayInfo(symbol('check'));
    } catch (Exception $e) {
        sayError(symbol('heavy_exclamation') . ' ' . $e->getMessage(), false);

        throw $e;
    }

}

newLine();

// Fill profiles content to wrapper template
sayInline($stepIndex++ . '. Fill wrapper ');

$filler->setFiller($config['filler']['wrapper']);
$filler->setTemplateFile(PROJECT_DIR . DS . $config['file']['wrapper']);

$data = [
    'profiles' => $profiles,
    'filled_profiles' => $filledProfiles,
    'content' => implode($config['profile_separate'], $filledProfiles)
];
$output = $filler->fill($data);

file_put_contents(PROJECT_DIR . DS . $config['file']['output'], $output);

sayInfo(symbol('check'));

newLine(3);
sayInfo("Complete " . symbol('beer_click'));
newLine(2);
