<?php
/**
 * Created by gitkv.
 * E-mail: gitkv@ya.ru
 * GitHub: gitkv
 */

namespace Tmconsulting\Uniteller\Tests\Recurrent;

use Tmconsulting\Uniteller\Http\HttpManagerInterface;
use Tmconsulting\Uniteller\Order\Order;
use Tmconsulting\Uniteller\Order\Status;
use Tmconsulting\Uniteller\Recurrent\RecurrentRequest;
use Tmconsulting\Uniteller\Tests\TestCase;

class RecurrentRequestTest extends TestCase
{
    public function testCanRequestHandleResponse()
    {
        $manager = $this->createMock(HttpManagerInterface::class);
        $manager
            ->expects($this->once())
            ->method('request')
            ->willReturn($this->getStubContents('recurrent', 'csv'));

        $request = new RecurrentRequest();
        /** @var \Tmconsulting\Uniteller\Order\Order $order */
        foreach ($request->execute($manager) as $order) {
            $this->assertInstanceOf(Order::class, $order);
            $this->assertEquals('Value of address', $order->getAddress());
            $this->assertEquals('Value of approvalCode', $order->getApprovalCode());
            $this->assertEquals('Value of bankName', $order->getBankName());
            $this->assertEquals('Value of billNumber', $order->getBillNumber());
            $this->assertEquals(null, $order->getBookingcomId());
            $this->assertEquals(null, $order->getBookingcomPincode());
            $this->assertEquals(null, $order->getCardIdp());
            $this->assertEquals('Value of cardHolder', $order->getCardHolder());
            $this->assertEquals('Value of cardNumber', $order->getCardNumber());
            $this->assertEquals('Value of cardType', $order->getCardType());
            $this->assertEquals('Value of comment', $order->getComment());
            $this->assertEquals('Value of currency', $order->getCurrency());
            $this->assertEquals(true, $order->isCvc2());
            $this->assertInstanceOf(\DateTime::class, $order->getDate());
            $this->assertEquals('Value of email', $order->getEmail());
            $this->assertEquals(null, $order->getEMoneyType());
            $this->assertEquals(null, $order->getEOrderData());
            $this->assertEquals('Value of error_code', $order->getErrorCode());
            $this->assertEquals('Value of error_comment', $order->getErrorComment());
            $this->assertEquals('Value of firstName', $order->getFirstName());
            $this->assertEquals(null, $order->getGdsPaymentPurposeId());
            $this->assertEquals(null, $order->getIData());
            $this->assertEquals('Value of ipAddress', $order->getIp());
            $this->assertEquals('Value of lastName', $order->getLastName());
            $this->assertEquals(null, $order->getLoanId());
            $this->assertEquals('Value of message', $order->getMessage());
            $this->assertEquals('Value of middleName', $order->getMiddleName());
            $this->assertEquals(false, $order->isNeedConfirm());
            $this->assertEquals('Value of orderNumber', $order->getOrderNumber());
            $this->assertEquals(null, $order->getParentOrderNumber());
            $this->assertEquals('Value of paymentType', $order->getPaymentType());
            $this->assertEquals('Value of phone', $order->getPhone());
            $this->assertEquals(null, $order->getPtCode());
            $this->assertEquals('Value of recommendation', $order->getRecommendation());
            $this->assertEquals('Value of response_code', $order->getResponseCode());
            $this->assertEquals(Status::AUTHORIZED, $order->getStatus());
            $this->assertEquals('Value of total', $order->getTotal());
            $this->assertInstanceOf(\DateTime::class, $order->getPacketDate());
        }
    }
}