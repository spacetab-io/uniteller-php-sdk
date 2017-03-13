<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Tests;


use Tmconsulting\Uniteller\Payment\PaymentInterface;
use Tmconsulting\Uniteller\Signature\SignatureInterface;
use Tmconsulting\Uniteller\Client;

class ClientTest extends TestCase
{
    public function testEmptyConstructor()
    {
        $reflect = new \ReflectionClass(Client::class);
        $this->assertEmpty($reflect->getConstructor()->getParameters());
    }

    public function testOptionsAccessorsAndMutators()
    {
        $uniteller = new Client();
        $uniteller->setShopId('shop_id');
        $uniteller->setBaseUri('https://google.com');
        $uniteller->setPassword('security-long-password');
        $uniteller->setLogin(330011);

        $this->assertSame('shop_id', $uniteller->getShopId());
        $this->assertSame('https://google.com', $uniteller->getBaseUri());
        $this->assertSame('security-long-password', $uniteller->getPassword());
        $this->assertSame(330011, $uniteller->getLogin());
    }

    public function testOptionKeyResolver()
    {
        $uniteller = new Client();
        $this->assertSame('default', $uniteller->getOption('shop_id', 'default'));
    }

    public function testDefaultObjectsIsRegistered()
    {
        $uniteller = new Client();
        $this->assertInstanceOf(PaymentInterface::class, $uniteller->getPayment());
        $this->assertInstanceOf(SignatureInterface::class, $uniteller->getSignature());
    }

    public function testSetOptionsUseArrayNotation()
    {
        $uniteller = new Client();
        $uniteller->setShopId('111');
        $uniteller->setPassword('pwd');

        $uniteller->setOptions([
            'password' => 1234,
            'base_uri' => 'https://google.com'
        ]);

        $true = [
            'shop_id'  => '111',
            'password' => 1234,
            'base_uri' => 'https://google.com',
        ];

        $this->assertSame($true, $uniteller->getOptions());
    }
}