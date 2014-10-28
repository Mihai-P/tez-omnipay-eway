<?php

namespace Omnipay\Eway31;

/**
 * eWAY Rapid 3.0 Gateway
 */
class RapidGateway extends \Omnipay\Eway\RapidGateway
{
    public function getName()
    {
        return 'eWAY Rapid 3.1';
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Stripe\Message\CreateCardRequest
     */
    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Eway31\Message\CreateCardRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Stripe\Message\CreateCardRequest
     */
    public function updateCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Eway31\Message\UpdateCardRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Stripe\Message\CreateCardRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Eway31\Message\RapidPurchaseRequest', $parameters);
    }
}
