<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 17/05/2017
 */

namespace Tmconsulting\Uniteller\Tests\Results;

use Tmconsulting\Uniteller\Http\HttpManagerInterface;
use Tmconsulting\Uniteller\Order\Order;
use Tmconsulting\Uniteller\Order\Status;
use Tmconsulting\Uniteller\Results\ResultsRequest;
use Tmconsulting\Uniteller\Tests\TestCase;

class ResultsRequestTest extends TestCase
{
    public function testCanRequestHandleResponse()
    {
        $manager = $this->createMock(HttpManagerInterface::class);
        $manager
            ->expects($this->once())
            ->method('request')
            ->willReturn($this->getStubContents('cancel'));

        $request = new ResultsRequest();
        /** @var \Tmconsulting\Uniteller\Order\Order $order */
        foreach ($request->execute($manager) as $order) {
            $this->assertInstanceOf(Order::class, $order);
            $this->assertEquals('Value of address', $order->getAddress());
            $this->assertEquals('Value of approvalcode', $order->getApprovalCode());
            $this->assertEquals('Value of bankname', $order->getBankName());
            $this->assertEquals('Value of billnumber', $order->getBillNumber());
            $this->assertEquals('Value of bookingcom_id', $order->getBookingcomId());
            $this->assertEquals('Value of bookingcom_pincode', $order->getBookingcomPincode());
            $this->assertEquals('Value of card_idp', $order->getCardIdp());
            $this->assertEquals('Value of cardholder', $order->getCardHolder());
            $this->assertEquals('Value of cardnumber', $order->getCardNumber());
            $this->assertEquals('Value of cardtype', $order->getCardType());
            $this->assertEquals('Value of comment', $order->getComment());
            $this->assertEquals('Value of currency', $order->getCurrency());
            $this->assertEquals(true, $order->isCvc2());
            $this->assertInstanceOf(\DateTime::class, $order->getDate());
            $this->assertEquals('Value of email', $order->getEmail());
            $this->assertEquals('Value of emoneytype', $order->getEMoneyType());
            $this->assertEquals(['foo' => 'bar', 'baz' => 'bue'], $order->getEOrderData());
            $this->assertEquals('Value of error_code', $order->getErrorCode());
            $this->assertEquals('Value of error_comment', $order->getErrorComment());
            $this->assertEquals('Value of firstname', $order->getFirstName());
            $this->assertEquals('Value of gds_payment_purpose_id', $order->getGdsPaymentPurposeId());
            $this->assertEquals('Value of idata', $order->getIData());
            $this->assertEquals('Value of ipaddress', $order->getIp());
            $this->assertEquals('Value of lastname', $order->getLastName());
            $this->assertEquals('Value of loan_id', $order->getLoanId());
            $this->assertEquals('Value of message', $order->getMessage());
            $this->assertEquals('Value of middlename', $order->getMiddleName());
            $this->assertEquals(true, $order->isNeedConfirm());
            $this->assertEquals('Value of ordernumber', $order->getOrderNumber());
            $this->assertEquals('Value of parent_order_number', $order->getParentOrderNumber());
            $this->assertEquals('Value of paymenttype', $order->getPaymentType());
            $this->assertEquals('Value of phone', $order->getPhone());
            $this->assertEquals('Value of pt_code', $order->getPtCode());
            $this->assertEquals('Value of recommendation', $order->getRecommendation());
            $this->assertEquals('Value of response_code', $order->getResponseCode());
            $this->assertEquals(Status::PAID, $order->getStatus());
            $this->assertEquals('Value of total', $order->getTotal());
            $this->assertInstanceOf(\DateTime::class, $order->getPacketDate());
        }
    }
}