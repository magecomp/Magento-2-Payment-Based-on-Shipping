<?php

namespace Magecomp\Restrictpaymentbyship\Plugin\Model;

use Magecomp\Restrictpaymentbyship\Helper\Data;

class Methodlist
{
    protected $_helper;

    public function __construct(Data $helper)
    {
        $this->_helper = $helper;
    }

    private function getShippingMethodFromQuote($quote)
    {
        if ($quote) {
            return $quote->getShippingAddress()->getShippingMethod();
        }
        return '';
    }

    public function afterGetAvailableMethods(
        \Magento\Payment\Model\MethodList $subject,
        $availableMethods,
        \Magento\Quote\Api\Data\CartInterface $quote = null
    )
    {
        if ($this->_helper->isEnabled()) {
            $shippingMethod = $this->getShippingMethodFromQuote($quote);
            foreach ($availableMethods as $key => $method) {
                if (($this->_helper->isgetpayment($method->getCode()) == true) && ($this->_helper->isgetShipping($shippingMethod) == true)) {
                    unset($availableMethods[$key]);
                }
            }
        }
        return $availableMethods;
    }
}
