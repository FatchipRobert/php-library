<?php
/**
 * Copyright (c) Ratepay GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RatePAY\Tests\Unit\Model\Request\SubModel\Content;

use PHPUnit\Framework\TestCase;
use RatePAY\Model\Request\SubModel\Content\Payment;
use RatePAY\ModelBuilder;

class PaymentTest extends TestCase
{
    public function testHandleCurrency()
    {
        $payment = (new Payment())
            ->setMethod('INVOICE')
            ->setCurrency('EUR')
            ->setAmount(100.00);

        $array = $payment->toArray();

        $expected = [
            'attributes' => [
                'method' => ['value' => 'INVOICE'],
                'currency' => ['value' => 'EUR'],
            ],
            'amount' => ['value' => 100.00],
        ];

        $this->assertEquals($expected, $array);
    }

    public function testCurrencyIsUppercased()
    {
        $payment = (new Payment())
            ->setMethod('INVOICE')
            ->setCurrency('eur')
            ->setAmount(100.00);

        $array = $payment->toArray();

        $this->assertEquals('EUR', $array['attributes']['currency']['value']);
    }

    public function testCurrencyIsOptional()
    {
        $payment = (new Payment())
            ->setMethod('INVOICE')
            ->setAmount(100.00);

        $array = $payment->toArray();

        $this->assertNull($payment->getCurrency());
        $this->assertArrayNotHasKey('currency', $array['attributes']);
    }

    public function testGetCurrency()
    {
        $payment = new Payment();
        $payment->setCurrency('EUR');

        $this->assertEquals('EUR', $payment->getCurrency());
    }

    public function testHandleCurrencyByModelBuilder()
    {
        $builder = new ModelBuilder('Payment');
        $builder->setArray([
            'Method' => 'INVOICE',
            'Currency' => 'EUR',
            'Amount' => 100.00,
        ]);

        $array = $builder->getModel()->toArray();

        $this->assertEquals('EUR', $array['attributes']['currency']['value']);
    }
}
