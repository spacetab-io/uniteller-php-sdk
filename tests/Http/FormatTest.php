<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 17/05/2017
 */

namespace Tmconsulting\Uniteller\Tests\Http;

use BadMethodCallException;
use Tmconsulting\Uniteller\Exception\FormatNotSupportedException;
use Tmconsulting\Uniteller\Exception\RequestNotSupportedException;
use Tmconsulting\Uniteller\Http\Format;
use Tmconsulting\Uniteller\Request\RequestInterface;
use Tmconsulting\Uniteller\Tests\TestCase;

class FormatTest extends TestCase
{
    public function testCanNotResolveUnsupportedRequest()
    {
        $this->expectException(RequestNotSupportedException::class);
        $this->expectExceptionMessage('Request [unknown] not supported here.');

        Format::resolveXml('unknown');
    }

    public function testCanNotResolveUnsupportedFormat()
    {
        $this->expectException(FormatNotSupportedException::class);
        $this->expectExceptionMessage('Format [xml] not supported for request [recurrent].');

        Format::resolveXml(RequestInterface::REQUEST_RECURRENT);
    }

    public function testCanCallBadMagicStaticMethod()
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Method [resolvingJson] not found.');

        Format::resolvingJson('unknown');
    }

    public function testCanResolveSupportedFormat()
    {
        $value = Format::resolveXml(RequestInterface::REQUEST_CONFIRM);
        $this->assertEquals(3, $value);
    }
}