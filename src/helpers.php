<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller;

/**
 * @param $array
 * @param $key
 * @param null $default
 * @return mixed
 */
function array_get($array, $key, $default = null)
{
    if (! array_key_exists($key, $array)) {
        return $default;
    }

    return $array[$key];
}

/**
 * @param $object
 * @param $key
 * @param null $default
 * @return mixed
 */
function xml_get($object, $key, $default = null)
{
    if (empty((string) $object->{$key})) {
        return $default;
    }

    if (trim((string) $object->{$key}) === '*НЕ ЗАДАВАЛСЯ*') {
        return $default;
    }

    return (string) $object->{$key};
}

/**
 * @param string $string
 * @param bool $isFlat
 * @return array|mixed
 */
function csv_to_array($string, $isFlat = false)
{
    $lines = explode("\n", trim($string));
    $headers = str_getcsv(array_shift($lines), ';');
    $data = [];
    foreach ($lines as $line) {
        $row = [];
        foreach (str_getcsv($line, ';') as $key => $field) {
            $row[$headers[$key]] = $field;
        }
        $data[] = array_filter($row);
    }

    if ($isFlat && !empty($data)) {
        $data = $data[0];
    }

    return $data;
}

/**
 * @param $array
 * @param array $excludeKeys
 * @return mixed
 */
function array_except($array, array $excludeKeys)
{
    foreach ($excludeKeys as $key) {
        unset($array[$key]);
    }

    return $array;
}