<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Tests\Signature;

use Tmconsulting\Uniteller\Signature\SignaturePayment;
use Tmconsulting\Uniteller\Signature\SignatureRecurrent;
use Tmconsulting\Uniteller\Tests\TestCase;

class SignatureTest extends TestCase
{
    public function testPaymentSignatureCreation()
    {
        $sig = (new SignaturePayment)
            ->setShopIdp('ACME')
            ->setOrderIdp('FOO')
            ->setSubtotalP(100)
            ->setLifeTime(300)
            ->setCustomerIdp('short_shop_string')
            ->setPassword('LONG-PWD')
            ->create();

        $this->assertSame('3D1D6F830384886A81AD672F66392B03', $sig);
    }


    public function testRecurrentSignatureCreation()
    {
        $sig = (new SignatureRecurrent())
            ->setShopIdp('ACME')
            ->setOrderIdp('FOO')
            ->setSubtotalP(100)
            ->setParentOrderIdp('BAR')
            ->setPassword('LONG-PWD')
            ->create();

        $this->assertSame('A5FE1C95A2819EBACFC2145EE83742F6', $sig);
    }

    public function testSignatureVerifying()
    {
        $sig = new SignaturePayment;

        $results = $sig->verify('3F728AA479E50F5B10EE6C20258BFF88', [
            'Order_ID' => 'FOO',
            'Status'   => 'paid',
            'Password' => 'LONG-PWD',
        ]);

        $this->assertTrue($results);
    }
}