<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Tests;

use Tmconsulting\Uniteller\ArraybleInterface;
use Tmconsulting\Uniteller\Cancel\CancelRequest;
use Tmconsulting\Uniteller\Client;
use Tmconsulting\Uniteller\Exception\NotImplementedException;
use Tmconsulting\Uniteller\Http\HttpManagerInterface;
use Tmconsulting\Uniteller\Payment\PaymentInterface;
use Tmconsulting\Uniteller\Request\RequestInterface;
use Tmconsulting\Uniteller\Signature\SignatureInterface;

class ClientTest extends TestCase
{
    public function testShouldBeConstructedWithoutArguments()
    {
        new Client();
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
        $this->assertInstanceOf(SignatureInterface::class, $uniteller->getSignaturePayment());
        $this->assertInstanceOf(SignatureInterface::class, $uniteller->getSignatureRecurrent());
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

    public function testGivenArgumentShouldBeImplementHttpManagerInterface()
    {
        $part1 = 'Argument 1 passed to ' . Client::class . '::setHttpManager()';
        $part2 = HttpManagerInterface::class;

        $client = new Client();
        try {
            $client->setHttpManager(new \stdClass());
        } catch (\Exception $e) { // PHP 5.6
            // Argument 1 passed to Tmconsulting\Uniteller\Client::setHttpManager()
            // must be an instance of Tmconsulting\Uniteller\Http\HttpManagerInterface,
            // instance of stdClass given
            // 4096 - is equivalet to the error above.
            $this->assertEquals(4096, $e->getCode());
            $this->assertStringStartsWith($part1, $e->getMessage());
            $this->assertContains($part2, $e->getMessage());
        } catch (\Throwable $e) { // PHP 7
            $this->assertStringStartsWith($part1, $e->getMessage());
            $this->assertContains($part2, $e->getMessage());
        }

        $client->setHttpManager($this->createMock(HttpManagerInterface::class));
        $this->assertInstanceOf(HttpManagerInterface::class, $client->getHttpManager());
    }

    /**
     * @return array
     */
    public function provideMethodsWhenHaveAnFirstArgumentIsRequestInterface()
    {
        return [
            ['registerCancelRequest'],
            ['registerResultsRequest'],
        ];
    }

    /**
     * @dataProvider provideMethodsWhenHaveAnFirstArgumentIsRequestInterface
     * @param $methodName
     */
    public function testGivenArgumentShouldBeTypeHintedAsRequestInterface($methodName)
    {
        $reflect = new \ReflectionClass(Client::class);
        $first   = $reflect->getMethod($methodName)->getParameters()[0]->getClass()->getName();

        $this->assertEquals(RequestInterface::class, $first);
    }

    public function testCanRequestMethodsMayReturnCorrectResult()
    {
        $client = new Client();
        $client->registerCancelRequest($this->createMock(RequestInterface::class));
        $client->registerResultsRequest($this->createMock(RequestInterface::class));
        $client->registerRecurrentRequest($this->createMock(RequestInterface::class));

        $this->assertInstanceOf(RequestInterface::class, $client->getCancelRequest());
        $this->assertInstanceOf(RequestInterface::class, $client->getResultsRequest());
        $this->assertInstanceOf(RequestInterface::class, $client->getRecurrentRequest());
    }

    public function testShouldBePaymentMethodBuildCorrectArray()
    {
        $payment = $this->createMock(PaymentInterface::class);
        $payment
            ->expects($this->once())
            ->method('execute')
            ->willReturnCallback(function ($array) {
                $this->assertArrayHasKey('Shop_IDP', $array);
                $this->assertArrayHasKey('Signature', $array);
            });

        $client = new Client();
        $client->registerPayment($payment);

        $client->payment([]);
    }

    public function testCanCancelMethodGiveControlToTheRequestClass()
    {
        $request = $this->createMock(RequestInterface::class);
        $request
            ->expects($this->at(1))
            ->method('execute')
            ->willReturnCallback(function ($manager, $array) {
                $this->assertInstanceOf(HttpManagerInterface::class, $manager);
                $this->assertTrue(is_array($array));
            });

        $client = new Client();
        $client->registerCancelRequest($request);
        $client->registerResultsRequest($request);
        $client->registerRecurrentRequest($request);

        $client->cancel([]);
        $client->results([]);

        $this->assertInstanceOf(HttpManagerInterface::class, $client->getHttpManager());
    }

    public function testCanUseCustomHttpManager()
    {
        $cancel = $this->createMock(CancelRequest::class);
        $cancel
            ->expects($this->once())
            ->method('execute');

        $client = new Client();
        $client->setHttpManager(new HttpManagerStub());
        $client->registerCancelRequest($cancel);

        $client->cancel([]);

        $this->assertInstanceOf(HttpManagerStub::class, $client->getHttpManager());
    }

    /**
     * @return array
     */
    public function provideUnsupportedRequestMethods()
    {
        return [
            ['confirm'],
            ['card'],
        ];
    }

    /**
     * @dataProvider provideUnsupportedRequestMethods
     * @param $methodName
     */
    public function testShouldBeUnsupportedMethodsThrowException($methodName)
    {
        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessageRegExp('/In current moment, feature \[.*\] not implemented./');
        $client = new Client();
        $client->{$methodName}([]);
    }

    public function provideActionsWhichShouldBeAcceptArrayble()
    {
        return [
            ['payment'],
            ['cancel'],
            ['results'],
        ];
    }

    /**
     * @dataProvider provideActionsWhichShouldBeAcceptArrayble
     * @param $methodName
     */
    public function testShouldBeActionsAcceptClassesWhichImplementArraybleInterface($methodName)
    {
        $request = $this->createMock(RequestInterface::class);
        $request->method('execute');

        $client = new Client();
        $client->registerResultsRequest($request);
        $client->registerCancelRequest($request);
        $client->registerRecurrentRequest($request);
        $client->registerPayment($this->createMock(PaymentInterface::class));

        $arrayble = $this->createMock(ArraybleInterface::class);
        $arrayble
            ->method('toArray')
            ->willReturn([]);

        $client->{$methodName}($arrayble);
    }

}

class HttpManagerStub implements HttpManagerInterface {

    /**
     * @param $uri
     * @param string $method
     * @param null $data
     * @param array $headers
     * @return string
     */
    public function request($uri, $method = 'POST', $data = null, array $headers = [])
    {
        // TODO: Implement request() method.
    }
}