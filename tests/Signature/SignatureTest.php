<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Tests\Signature;

use Tmconsulting\Uniteller\Signature\Signature;
use Tmconsulting\Uniteller\Tests\TestCase;

class SignatureTest extends TestCase
{
    public function testSignatureCreation()
    {
        $sig = new Signature;

        $created = $sig->create([
            'Shop_IDP'     => 'ACME',
            'Order_IDP'    => 'FOO',
            'Subtotal_P'   => '100',
            'Lifetime'     => 300,
            'Customer_IDP' => 'short_shop_string',
            'Password'     => 'LONG-PWD',
        ]);

        $this->assertSame('3D1D6F830384886A81AD672F66392B03', $created);
    }

    public function testSignatureVerifying()
    {
        $sig = new Signature;

        $results = $sig->verify('3F728AA479E50F5B10EE6C20258BFF88', [
            'Order_ID' => 'FOO',
            'Status'   => 'paid',
            'Password' => 'LONG-PWD',
        ]);

        $this->assertTrue($results);
    }
}