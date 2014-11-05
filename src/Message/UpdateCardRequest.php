<?php

namespace Omnipay\Eway31\Message;

/**
 * Stripe Update Credit Card Request
 */
class UpdateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['Method'] = 'UpdateTokenCustomer';
        $data['DeviceID'] = 'https://github.com/adrianmacneil/omnipay';
        $data['RedirectUrl'] = $this->getReturnUrl();
        $data['TransactionType'] = "Recurring";
        $data['Customer'] = array();
        $data['Customer']['Title'] = 'Mr.';
        $data['Customer']['TokenCustomerID'] = $this->getCardReference();
        $card = $this->getCard();
        if ($card) {
            $data['Customer']['FirstName'] = $card->getFirstName();
            $data['Customer']['LastName'] = $card->getLastName();
            $data['Customer']['CardDetails'] = [
                "Name" => $card->getFirstName() . ' ' . $card->getLastName(),
                "Number" => $card->getNumber(),
                "ExpiryMonth" => $card->getExpiryMonth(),
                "ExpiryYear" => $card->getExpiryYear(),
                "StartMonth" => "",
                "StartYear" => "",
                "IssueNumber" => "",
                "CVN" => $card->getCvv()
            ];
        }

        return $data;
    }
}
