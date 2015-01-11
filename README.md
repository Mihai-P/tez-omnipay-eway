# Omnipay: eWay31

**eWay driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements eWay support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "tez/omnipay-eway31": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Eway_Rapid31

For general usage instructions, please see the main [Omnipay](https://github.com/Mihai-P/tez-omnipay-eway)
repository.

## Examples

```php
        $gateway = GatewayFactory::create('Eway31_Rapid');
        $gateway->setTestMode(true);
        $gateway->setApiKey(\Yii::$app->params['eway']['key']);
        $gateway->setPassword(\Yii::$app->params['eway']['password']);
        $card = new CreditCard([
            'firstName' => 'Bobby',
            'lastName' => 'Tables',
            'number' => '4444333322221111',
            'cvv' => '123',
            'expiryMonth' => 12,
            'expiryYear' => '2017',
            'email' => 'testEway@biti.ro',
        ]);
        $response = $gateway->createCard(['card' => $card])->send();
        if ($response->isSuccessful()) {
            $tokenCustomerID = $response->getTokenCustomerID();
            echo "We have a token ID<br>";
            // payment was successful: update database
        } elseif ($response->isRedirect()) {
            // redirect to offsite payment gateway
            $response->redirect();
            die('error');
        } else {
            // payment failed: display message to customer
            print_r($response->getCode());
            print_r($response);
            die('payment failed');
        }

        if($tokenCustomerID) {
            $card2 = new CreditCard([
                'firstName' => 'Mi',
                'lastName' => 'Pe',
                'number' => '4444333322221111',
                'cvv' => '123',
                'expiryMonth' => 12,
                'expiryYear' => '2016',
                'email' => 'testEway@biti.ro',
            ]);
            echo "UPDATE<br>";
            $response = $gateway->updateCard(['cardReference' => $tokenCustomerID, 'card' => $card2])->send();
            print_r($response->getCode());

            $card3 = new CreditCard([
                'firstName' => 'Mi',
                'lastName' => 'Pe',
                //'cvv' => '123',
            ]);
            echo "PURCHASE<br>";
            $response = $gateway->purchase(['amount' => '10.00', 'cardReference' => $tokenCustomerID, 'transactonId' => 'Invoice1', 'description' => 'Invoice1 billed', 'currency' => 'AUD', 'card' => $card3])->send();
            //print_r($response);
            print_r($response->getCode());

            echo "PURCHASE<br>";
            $response = $gateway->purchase(['amount' => '10.00', 'cardReference' => $tokenCustomerID, 'transactonId' => 'Invoice1', 'description' => 'Invoice1 billed', 'currency' => 'AUD'])->send();
            //print_r($response);
            print_r($response->getCode());
        }
```
 