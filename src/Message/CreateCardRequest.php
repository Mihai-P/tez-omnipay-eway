<?php

namespace Omnipay\Eway31\Message;

/**
 * Stripe Create Credit Card Request
 */
class CreateCardRequest extends AbstractRequest
{

    public function getData()
    {
        $data = array();
        $data['Method'] = 'CreateTokenCustomer';
        $data['DeviceID'] = 'https://github.com/adrianmacneil/omnipay';
        $data['RedirectUrl'] = $this->getReturnUrl();
        $data['TransactionType'] = "Purchase";
        $data['Customer'] = array();
        $card = $this->getCard();
        if ($card) {
            $data['Customer']['Title'] = 'Mr.';
            $data['Customer']['FirstName'] = $card->getFirstName();
            $data['Customer']['LastName'] = $card->getLastName();
            $data['Customer']['CompanyName'] = $card->getCompany();
            $data['Customer']['Street1'] = $card->getAddress1();
            $data['Customer']['Street2'] = $card->getAddress2();
            $data['Customer']['City'] = $card->getCity();
            $data['Customer']['State'] = $card->getState();
            $data['Customer']['PostalCode'] = $card->getPostCode();
            $data['Customer']['Country'] = "au";
            $data['Customer']['Email'] = $card->getEmail();
            $data['Customer']['Phone'] = $card->getPhone();
            $data['Customer']['CardDetails'] = [
                "Name" => $card->getFirstName() . ' ' .$card->getLastName(),
                "Number" =>  $card->getNumber(),
                "ExpiryMonth" => $card->getExpiryMonth(),
                "ExpiryYear" => $card->getExpiryYear(),
                "StartMonth" =>  "",
                "StartYear" =>  "",
                "IssueNumber" =>  "",
                "CVN" =>  $card->getCvv()
            ];
        }

        return $data;
    }
}
