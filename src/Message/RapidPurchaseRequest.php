<?php

namespace Omnipay\Eway31\Message;

/**
 * eWAY Rapid 3.0 Purchase Request
 */
class RapidPurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['Method'] = 'ProcessPayment';
        $data['DeviceID'] = 'https://github.com/adrianmacneil/omnipay';
        $data['TotalAmount'] = 0;
        $data['RedirectUrl'] = $this->getReturnUrl();
        $data['TransactionType'] = "Recurring";
        $data['Customer'] = array();
        $data['Customer']['TokenCustomerID'] = $this->getCardReference();

        $data['Payment'] = array();
        $data['Payment']['TotalAmount'] = $this->getAmountInteger();
        $data['Payment']['InvoiceNumber'] = $this->getTransactionId();
        $data['Payment']['InvoiceDescription'] = $this->getDescription();
        $data['Payment']['CurrencyCode'] = $this->getCurrency();

        $card = $this->getCard();
        if ($card) {
            $data['Customer']['FirstName'] = $card->getFirstName();
            $data['Customer']['LastName'] = $card->getLastName();
            $data['Customer']['CardDetails'] = [
                "CVN" => $card->getCvv()
            ];
        }

        return $data;
    }
}
