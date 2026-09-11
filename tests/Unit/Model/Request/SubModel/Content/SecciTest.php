<?php
/**
 * Copyright (c) Ratepay GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RatePAY\Tests\Unit\Model\Request\SubModel\Content;

use PHPUnit\Framework\TestCase;
use RatePAY\Exception\ModelException;
use RatePAY\Model\Request\SubModel\Content\Secci;
use RatePAY\ModelBuilder;

class SecciTest extends TestCase
{
    public function testToArrayWithMandatoryFields()
    {
        $secci = (new Secci())
            ->setPaymentMethod('INSTALLMENT')
            ->setDeliveryMethod('EMAIL');

        $array = $secci->toArray();

        $expected = [
            'payment-method' => ['value' => 'INSTALLMENT'],
            'delivery-method' => ['value' => 'EMAIL'],
        ];

        $this->assertEquals($expected, $array);
    }

    public function testToArrayWithAllFields()
    {
        $secci = (new Secci())
            ->setPaymentMethod('INSTALLMENT')
            ->setDeliveryMethod('EMAIL')
            ->setEmail('test@example.com')
            ->setAction('REQUEST')
            ->setLanguage('DE')
            ->setCountry('DE');

        $array = $secci->toArray();

        $expected = [
            'payment-method' => ['value' => 'INSTALLMENT'],
            'delivery-method' => ['value' => 'EMAIL'],
            'email' => ['value' => 'test@example.com'],
            'action' => ['value' => 'REQUEST'],
            'language' => ['value' => 'DE'],
            'country' => ['value' => 'DE'],
        ];

        $this->assertEquals($expected, $array);
    }

    public function testSetterReturnsModel()
    {
        $secci = new Secci();

        $this->assertSame($secci, $secci->setPaymentMethod('INSTALLMENT'));
    }

    public function testGetters()
    {
        $secci = (new Secci())
            ->setPaymentMethod('INSTALLMENT')
            ->setDeliveryMethod('EMAIL')
            ->setEmail('test@example.com')
            ->setAction('REQUEST')
            ->setLanguage('DE')
            ->setCountry('DE');

        $this->assertEquals('INSTALLMENT', $secci->getPaymentMethod());
        $this->assertEquals('EMAIL', $secci->getDeliveryMethod());
        $this->assertEquals('test@example.com', $secci->getEmail());
        $this->assertEquals('REQUEST', $secci->getAction());
        $this->assertEquals('DE', $secci->getLanguage());
        $this->assertEquals('DE', $secci->getCountry());
    }

    public function testGetterReturnsNullIfNotSet()
    {
        $secci = new Secci();

        $this->assertNull($secci->getEmail());
    }

    public function testThrowErrorIfNoPaymentMethod()
    {
        $secci = new Secci();
        $secci->setDeliveryMethod('EMAIL');

        $this->expectException(ModelException::class);
        $this->expectExceptionMessage('Model exception : Field \'PaymentMethod\' is required');

        $secci->toArray();
    }

    public function testThrowErrorIfNoDeliveryMethod()
    {
        $secci = new Secci();
        $secci->setPaymentMethod('INSTALLMENT');

        $this->expectException(ModelException::class);
        $this->expectExceptionMessage('Model exception : Field \'DeliveryMethod\' is required');

        $secci->toArray();
    }

    public function testBuildByModelBuilder()
    {
        $builder = new ModelBuilder('Secci');
        $builder->setArray([
            'PaymentMethod' => 'INSTALLMENT',
            'DeliveryMethod' => 'EMAIL',
            'Email' => 'test@example.com',
        ]);

        $secci = $builder->getModel();

        $this->assertInstanceOf(Secci::class, $secci);

        $expected = [
            'payment-method' => ['value' => 'INSTALLMENT'],
            'delivery-method' => ['value' => 'EMAIL'],
            'email' => ['value' => 'test@example.com'],
        ];

        $this->assertEquals($expected, $secci->toArray());
    }
}
