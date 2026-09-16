<?php

/*
 * Copyright (c) Ratepay GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RatePAY\Model\Request\SubModel\Content;

use RatePAY\Model\Request\SubModel\AbstractModel;

class Secci extends AbstractModel
{
    /**
     * List of admitted fields.
     * Each field is public accessible by certain getter and setter.
     * E.g:
     * Set payment method value by using setPaymentMethod(var). Get payment method by using getPaymentMethod(). (Please consider the camel case).
     *
     * Settings:
     * mandatory            = field is mandatory (or optional)
     * mandatoryByRule      = field is mandatory if rule is passed
     * optionalByRule       = field will only returned if rule is passed
     * default              = default value if no different value is set
     * isAttribute          = field is xml attribute to parent object
     * isAttributeTo        = field is xml attribute to field (in value)
     * instanceOf           = value has to be an instance of class (in value)
     * cdata                = value will be wrapped in CDATA tag
     * uppercase            = change value to uppercase
     *
     * @var array
     */
    public $admittedFields = [
        'DeliveryMethod' => [
            'mandatory' => true,
            'uppercase' => true,
        ],
        'Email' => [
            'mandatoryByRule' => true,
        ],
        'Action' => [
            'mandatory' => false,
            'uppercase' => true,
        ],
        'Language' => [
            'mandatory' => false,
            'uppercase' => true,
        ],
        'CountryCode' => [
            'mandatory' => false,
            'uppercase' => true,
        ],
    ];

    /**
     * Installment details rule : if payment method is installment, InstallmentDetails are mandatory.
     *
     * @return bool
     */
    protected function rule()
    {
        if ('EMAIL' == $this->admittedFields['DeliveryMethod']['value'] &&
            (!key_exists('value', $this->admittedFields['Email']))
        ) {
            $this->setErrorMsg('email details missing');

            return false;
        }

        return true;
    }

    /**
     * @param string $paymentMethod
     *
     * @return self
     *
     * @throws \RatePAY\Exception\ModelException
     */
    public function setPaymentMethod($paymentMethod)
    {
        return $this->__set('PaymentMethod', $paymentMethod);
    }

    /**
     * @param string $deliveryMethod
     *
     * @return self
     *
     * @throws \RatePAY\Exception\ModelException
     */
    public function setDeliveryMethod($deliveryMethod)
    {
        return $this->__set('DeliveryMethod', $deliveryMethod);
    }

    /**
     * @param string $email
     *
     * @return self
     *
     * @throws \RatePAY\Exception\ModelException
     */
    public function setEmail($email)
    {
        return $this->__set('Email', $email);
    }

    /**
     * @param string $action
     *
     * @return self
     *
     * @throws \RatePAY\Exception\ModelException
     */
    public function setAction($action)
    {
        return $this->__set('Action', $action);
    }

    /**
     * @param string $language
     *
     * @return self
     *
     * @throws \RatePAY\Exception\ModelException
     */
    public function setLanguage($language)
    {
        return $this->__set('Language', $language);
    }

    /**
     * @param string $country
     *
     * @return self
     *
     * @throws \RatePAY\Exception\ModelException
     */
    public function setCountry($country)
    {
        return $this->__set('Country', $country);
    }
}
