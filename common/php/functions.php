<?php

/**
 * Read CSV file then return data
 * @param string $csvFile CSV file path
 * @param array|null $fields Array of fields name
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
