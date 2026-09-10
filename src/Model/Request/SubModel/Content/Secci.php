<?php

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
        'PaymentMethod' => [
            'mandatory' => true,
        ],
        'DeliveryMethod' => [
            'mandatory' => true,
        ],
        'Email' => [
            'mandatory' => false,
        ],
        'Action' => [
            'mandatory' => false,
        ],
        'Language' => [
            'mandatory' => false,
        ],
        'Country' => [
            'mandatory' => false,
        ],
    ];


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
