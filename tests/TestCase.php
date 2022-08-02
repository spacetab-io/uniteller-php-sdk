<?php

namespace Tmconsulting\Uniteller\Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $filename
     * @param string $type
     * @return bool|string
     */
    protected function getStubContents($filename, $type='xml')
    {
        return file_get_contents(__DIR__ . "/stub/$filename.$type");
    }
}
