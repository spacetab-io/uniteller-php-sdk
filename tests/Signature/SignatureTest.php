<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Tests\Signature;

use Tmconsulting\Uniteller\Signature\SignatureCallback;
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

    public function testCallbackSignatureCreation()
    {
        $sig = (new SignatureCallback())
            ->setOrderId('FOO')
            ->setStatus('paid')
            ->setPassword('LONG-PWD')
            ->create();

        $this->assertSame('3F728AA479E50F5B10EE6C20258BFF88', $sig);
    }

    public function testCallbackSignatureCreationWithFields()
    {
        $sig = (new SignatureCallback())
            ->setOrderId('FOO')
            ->setStatus('paid')
            ->setFields([
                'AcquirerID'   => 'fOO',
                'ApprovalCode' => 'BaR',
                'BillNumber'   => 'baz',
            ])
            ->setPassword('LONG-PWD')
            ->create();

        $this->assertSame('1F4E3B63AE408D0BE1E33965E6697236', $sig);
    }

    public function testPaymentSignatureVerifying()
    {
        $sig = (new SignaturePayment())
            ->setShopIdp('ACME')
            ->setOrderIdp('FOO')
            ->setSubtotalP(100)
            ->setLifeTime(300)
            ->setCustomerIdp('short_shop_string')
            ->setPassword('LONG-PWD');

        $this->assertTrue($sig->verify('3D1D6F830384886A81AD672F66392B03'));
    }

    public function testRecurrentSignatureVerifying()
    {
        $sig = (new SignatureRecurrent())
            ->setShopIdp('ACME')
            ->setOrderIdp('FOO')
            ->setSubtotalP(100)
            ->setParentOrderIdp('BAR')
            ->setPassword('LONG-PWD');

        $this->assertTrue($sig->verify('A5FE1C95A2819EBACFC2145EE83742F6'));
    }

    public function testCallbackSignatureVerifying()
    {
        $sig = (new SignatureCallback())
            ->setOrderId('FOO')
            ->setStatus('paid')
            ->setPassword('LONG-PWD');

        $this->assertTrue($sig->verify('3F728AA479E50F5B10EE6C20258BFF88'));
    }

    public function testCallbackSignatureVerifyingWithFields()
    {
        $sig = (new SignatureCallback())
            ->setOrderId('FOO')
            ->setStatus('paid')
            ->setFields([
                'AcquirerID'   => 'fOO',
                'ApprovalCode' => 'BaR',
                'BillNumber'   => 'baz',
            ])
            ->setPassword('LONG-PWD');

        $this->assertTrue($sig->verify('1F4E3B63AE408D0BE1E33965E6697236'));
    }
}