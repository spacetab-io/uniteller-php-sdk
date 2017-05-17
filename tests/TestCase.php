<?php

namespace Tmconsulting\Uniteller\Tests;

use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @param $filename
     * @return bool|string
     */
    protected function getStubContents($filename)
    {
        return file_get_contents(__DIR__ . "/stub/$filename.xml");
    }
}