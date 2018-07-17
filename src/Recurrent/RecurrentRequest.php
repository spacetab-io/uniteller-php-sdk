<?php
/**
 * Created by gitkv.
 * E-mail: gitkv@ya.ru
 * GitHub: gitkv
 */

namespace Tmconsulting\Uniteller\Recurrent;

use Tmconsulting\Uniteller\Http\HttpManagerInterface;
use Tmconsulting\Uniteller\Order\Order;
use Tmconsulting\Uniteller\Request\RequestInterface;
use Tmconsulting\Uniteller;

/**
 * Class CancelRequest
 *
 * @package Tmconsulting\Client\CancelRequest
 */
class RecurrentRequest implements RequestInterface
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
        $response = $httpManager->request('recurrent', 'POST', http_build_query($parameters), [], 'csv');
        $csv = Uniteller\csv_to_array($response);
        $array = [];
        foreach ($csv as $item) {
            $array[] = (new Order())
                ->setAddress(Uniteller\array_get($item, 'Address'))
                ->setApprovalCode(Uniteller\array_get($item, 'ApprovalCode'))
                ->setBankName(Uniteller\array_get($item, 'BankName'))
                ->setBillNumber(Uniteller\array_get($item, 'BillNumber'))
                //->setBookingcomId(Uniteller\array_get($item, 'bookingcom_id'))
                //->setBookingcomPincode(Uniteller\array_get($item, 'bookingcom_pincode'))
                //->setCardIdp(Uniteller\array_get($item, 'card_idp'))
                ->setCardHolder(Uniteller\array_get($item, 'CardHolder'))
                ->setCardNumber(Uniteller\array_get($item, 'CardNumber'))
                ->setCardType(Uniteller\array_get($item, 'CardType'))
                ->setComment(Uniteller\array_get($item, 'Comment'))
                ->setCurrency(Uniteller\array_get($item, 'Currency'))
                ->setCvc2((bool)Uniteller\array_get($item, 'CVC2', false))
                ->setDate(Uniteller\array_get($item, 'Date'))
                ->setEmail(Uniteller\array_get($item, 'Email'))
                //->setEMoneyType(Uniteller\array_get($item, 'emoneytype'))
                //->setEOrderData(Uniteller\array_get($item, 'eorderdata'))
                ->setErrorCode(Uniteller\array_get($item, 'Error_Code'))
                ->setErrorComment(Uniteller\array_get($item, 'Error_Comment'))
                ->setFirstName(Uniteller\array_get($item, 'FirstName'))
                //->setGdsPaymentPurposeId(Uniteller\array_get($item, 'gds_payment_purpose_id'))
                //->setIData(Uniteller\array_get($item, 'idata'))
                ->setIp(Uniteller\array_get($item, 'IPAddress'))
                ->setLastName(Uniteller\array_get($item, 'LastName'))
                //->setLoanId(Uniteller\array_get($item, 'loan_id'))
                ->setMessage(Uniteller\array_get($item, 'Message'))
                ->setMiddleName(Uniteller\array_get($item, 'MiddleName'))
                //->setNeedConfirm((bool)Uniteller\array_get($item, 'need_confirm'))
                ->setOrderNumber(Uniteller\array_get($item, 'OrderNumber'))
                //->setParentOrderNumber(Uniteller\array_get($item, 'parent_order_number'))
                ->setPaymentType(Uniteller\array_get($item, 'PaymentType'))
                ->setPhone(Uniteller\array_get($item, 'Phone'))
                //->setPtCode(Uniteller\array_get($item, 'pt_code'))
                ->setRecommendation(Uniteller\array_get($item, 'Recommendation'))
                ->setResponseCode(Uniteller\array_get($item, 'Response_Code'))
                ->setStatus(Uniteller\array_get($item, 'Status'))
                ->setTotal(Uniteller\array_get($item, 'Total'))
                ->setPacketDate(Uniteller\array_get($item, 'PacketDate'))
                ->setSignature(Uniteller\array_get($item, 'Signature'));
        }

        return $array;
    }
}