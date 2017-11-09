<?php

/**
 * Read CSV file then return data
 *
 * @param string     $csvFile CSV file path
 * @param array|null $fields  Array of fields name
 *
 * @return array
 */
function csvToArray($csvFile, array $fields = null)
{
    $result = [];
    $sizeOfFields = (null === $fields) ? 0 : count($fields);

    if (($handle = fopen($csvFile, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (!$sizeOfFields) {
                $result[] = $data;
                continue;
            }

            $record = array_fill_keys($fields, array_slice($data, 0, $sizeOfFields));
            $record = array_merge($record, array_slice($data, $sizeOfFields));

            $result[] = $record;
        }

        fclose($handle);
    }

    return $result;
}

/**
 * | CLI functions
 * |--------------------------------------------------------------------------
 */


function newLine($lines = 1)
{
    echo str_repeat("\n", max(1, $lines));
}

function sayBy($message, $colorProfile)
{
    CLI::getInstance()->say($message, $colorProfile);
}

function sayInline($message)
{
    sayBy($message, 'normal');
}

function say($message)
{
    sayBy($message, 'normal');
    newLine();
}

function sayInfo($message)
{
    sayBy($message, 'info');
    newLine();
}

function sayError($message, $exit = true)
{
    $cliInstance = CLI::getInstance();

    if ($message instanceof Exception) {
        sayBy($message->getMessage(), 'error');
        newLine();

        throw new $message;
    } else {
        sayBy($message, 'error');
        newLine();
    }

    if ($exit) {
        exit(1);
    }
}

function sayWarning($message)
{
    sayBy($message, 'warning');
    newLine();
}

/*
| Symbol functions
|--------------------------------------------------------------------------
*/

/**
 * @param string $name
 *
 * @return string
 * @throws Exception
 */
function symbol($name)
{
    $symbols = [
        'check' => "\xE2\x9C\x94",
        'beer_click' => "\xF0\x9F\x8D\xBB",
        'bear_mug' => "\xF0\x9F\x8D\xBA",
        'cross_mark' => "\xE2\x9D\x8C",
        'heavy_exclamation' => "\xE2\x9D\x97"
    ];

    if(!array_key_exists($name, $symbols)){
        $heavy_exclamation_symbol = $symbols['heavy_exclamation'];

        return $heavy_exclamation_symbol . $heavy_exclamation_symbol .' SYMBOL-NOT-FOUND'. $heavy_exclamation_symbol . $heavy_exclamation_symbol;
    }

    return $symbols[$name];
}