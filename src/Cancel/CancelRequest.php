<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 */

namespace Tmconsulting\Uniteller\Cancel;

use Tmconsulting\Uniteller\Http\HttpManagerInterface;
use Tmconsulting\Uniteller\Order\Order;
use Tmconsulting\Uniteller\Request\RequestInterface;
use Tmconsulting\Uniteller;

/**
 * Class CancelRequest
 *
 * @package Tmconsulting\Client\CancelRequest
 */
class CancelRequest implements RequestInterface
{
    /**
     * Выполнение запроса к шлюзу.
     *
     * @param \Tmconsulting\Uniteller\Http\HttpManagerInterface $httpManager
     * @param array $parameters
     * @return array
     */
    public function execute(HttpManagerInterface $httpManager, array $parameters = [])
    {
        $response = $httpManager->request('unblock', 'POST', http_build_query($parameters));
        $xml      = new \SimpleXMLElement($response);

        $array = [];
        foreach ($xml->orders->order as $item) {
            $array[] = (new Order())
                ->setAddress(Uniteller\xml_get($item, 'address'))
                ->setApprovalCode(Uniteller\xml_get($item, 'approvalcode'))
                ->setBankName(Uniteller\xml_get($item, 'bankname'))
                ->setBillNumber(Uniteller\xml_get($item, 'billnumber'))
                ->setBookingcomId(Uniteller\xml_get($item, 'bookingcom_id'))
                ->setBookingcomPincode(Uniteller\xml_get($item, 'bookingcom_pincode'))
                ->setCardIdp(Uniteller\xml_get($item, 'card_idp'))
                ->setCardHolder(Uniteller\xml_get($item, 'cardholder'))
                ->setCardNumber(Uniteller\xml_get($item, 'cardnumber'))
                ->setCardType(Uniteller\xml_get($item, 'cardtype'))
                ->setComment(Uniteller\xml_get($item, 'comment'))
                ->setCurrency(Uniteller\xml_get($item, 'currency'))
                ->setCvc2((bool)Uniteller\xml_get($item, 'cvc2'))
                ->setDate(Uniteller\xml_get($item, 'date'))
                ->setEmail(Uniteller\xml_get($item, 'email'))
                ->setEMoneyType(Uniteller\xml_get($item, 'emoneytype'))
                ->setEOrderData(Uniteller\xml_get($item, 'eorderdata'))
                ->setErrorCode(Uniteller\xml_get($item, 'error_code'))
                ->setErrorComment(Uniteller\xml_get($item, 'error_comment'))
                ->setFirstName(Uniteller\xml_get($item, 'firstname'))
                ->setGdsPaymentPurposeId(Uniteller\xml_get($item, 'gds_payment_purpose_id'))
                ->setIData(Uniteller\xml_get($item, 'idata'))
                ->setIp(Uniteller\xml_get($item, 'ipaddress'))
                ->setLastName(Uniteller\xml_get($item, 'lastname'))
                ->setLoanId(Uniteller\xml_get($item, 'loan_id'))
                ->setMessage(Uniteller\xml_get($item, 'message'))
                ->setMiddleName(Uniteller\xml_get($item, 'middlename'))
                ->setNeedConfirm((bool) Uniteller\xml_get($item, 'need_confirm'))
                ->setOrderNumber(Uniteller\xml_get($item, 'ordernumber'))
                ->setParentOrderNumber(Uniteller\xml_get($item, 'parent_order_number'))
                ->setPaymentType(Uniteller\xml_get($item, 'paymenttype'))
                ->setPhone(Uniteller\xml_get($item, 'phone'))
                ->setPtCode(Uniteller\xml_get($item, 'pt_code'))
                ->setRecommendation(Uniteller\xml_get($item, 'recommendation'))
                ->setResponseCode(Uniteller\xml_get($item, 'response_code'))
                ->setStatus(Uniteller\xml_get($item, 'status'))
                ->setTotal(Uniteller\xml_get($item, 'total'))
                ->setPacketDate(Uniteller\xml_get($item, 'packetdate'))
            ;
        }

        return $array;
    }
}