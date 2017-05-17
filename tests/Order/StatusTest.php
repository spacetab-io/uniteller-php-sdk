<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 17/05/2017
 */

namespace Tmconsulting\Uniteller\Tests\Order;

use Tmconsulting\Uniteller\Order\Status;
use Tmconsulting\Uniteller\Tests\TestCase;

class StatusTest extends TestCase
{
    /**
     * @return array
     */
    public function provideAvailableUnitellerStatuses()
    {
        return [
            [Status::NEWEST, 'new'],
            [Status::AUTHORIZED, 'authorized'],
            [Status::NOT_AUTHORIZED, 'not authorized'],
            [Status::PAID, 'paid'],
            [Status::CANCELLED, 'cancelled'],
            [Status::CANCELLED, 'canceled'],
            [Status::WAITING, 'waiting'],
            [null, 'unknown'],
        ];
    }

    /**
     * @dataProvider provideAvailableUnitellerStatuses
     * @param $expected
     * @param $name
     */
    public function testShouldBeStatusResolverAlwaysReturnCorrectResult($expected, $name)
    {
        $this->assertEquals($expected, Status::resolve($name));
    }
}