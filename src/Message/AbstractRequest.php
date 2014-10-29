<?php

namespace Omnipay\Eway31\Message;

/**
 * Stripe Abstract Request
 *
 * @method \Omnipay\Stripe\Message\Response send()
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://api.ewaypayments.com';
    protected $testEndpoint = 'https://api.sandbox.ewaypayments.com';

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function sendData($data)
    {
        $httpResponse = $this->httpClient->post($this->getEndpoint(), null, json_encode($data))
            ->setAuth($this->getApiKey(), $this->getPassword())
            ->send();

        return $this->response = new RapidResponse($this, $httpResponse->json());
    }

    public function getEndpoint()
    {
        return $this->getEndpointBase().'/DirectPayment.json';
    }

    public function getEndpointBase()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
