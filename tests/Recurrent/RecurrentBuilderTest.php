<?php
/**
 * Created by gitkv.
 * E-mail: gitkv@ya.ru
 * GitHub: gitkv
 */

namespace Tmconsulting\Uniteller\Tests\Recurrent;

use Tmconsulting\Uniteller\Recurrent\RecurrentBuilder;
use Tmconsulting\Uniteller\Tests\TestCase;

class RecurrentBuilderTest extends TestCase
{
    public function testBuildObject()
    {
        $builder = new RecurrentBuilder();
        $builder->setShopIdp('FOO');
        $builder->setParentShopIdp('BAR');
        $builder->setOrderIdp('BAZ');
        $builder->setParentOrderIdp('old');
        $builder->setSubtotalP(10);

        $expected = [
            'Shop_IDP'         => 'FOO',
            'Parent_Shop_IDP'  => 'BAR',
            'Order_IDP'        => 'BAZ',
            'Parent_Order_IDP' => 'old',
            'Subtotal_P'       => 10,
        ];

        $this->assertEquals($expected, $builder->toArray());
    }
}