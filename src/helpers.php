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
 * @return null|void
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
 * @return null
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