<?php
/**
 * eWay Rapid 3.1 Gateway
 */

namespace Omnipay\Eway31;

/**
 * eWay Rapid 3.1 Gateway
 *
 * All of the functionality of the Rapid 3.1 gateway is the same as the
 * functionality of the Rapid 3.0 gateway except for the 3 functions
 * extended here.
 *
 * Usage is described in \Omnipay\Common\AbstractGateway.
 *
 * @see \Omnipay\Common\AbstractGateway
 * @reference http://www.eway.com.au/
 * @reference http://en.wikipedia.org/wiki/EWay
 * @reference http://www.eway.com.au/developers/cool-stuff/sandbox-testing for sandbox testing
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
