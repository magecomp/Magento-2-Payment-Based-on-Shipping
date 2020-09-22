<?php

namespace Magecomp\Restrictpaymentbyship\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $_storeManager;
    const RESTRICTPAYMENTBYSHIP_GENRAL_ENABLED = 'restrictpaymentbyship/general/enable';
    const RESTRICTPAYMENTBYSHIP_GENRAL_SHIPPING = 'restrictpaymentbyship/general/shippingmethod';
    const RESTRICTPAYMENTBYSHIP_GENRAL_PAYMENT = 'restrictpaymentbyship/general/paymentmethod';

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    )
    {
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function isEnabled()
    {
        $configValue = $this->scopeConfig->getValue(
            self::RESTRICTPAYMENTBYSHIP_GENRAL_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->_storeManager->getStore()
        );
        return $configValue;
    }

    public function isgetShipping($shippingstatus)
    {
        $shippingstatuss = $this->isShipping();
        if (in_array($shippingstatus, explode(',', $shippingstatuss))) {
            return true;
        }
        return false;
    }

    public function isShipping()
    {
        $configValue = $this->scopeConfig->getValue(
            self::RESTRICTPAYMENTBYSHIP_GENRAL_SHIPPING,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->_storeManager->getStore()
        );
        return $configValue;
    }

    public function isgetpayment($paymentstatus)
    {
        $paymentstatuss = $this->isPayment();
        if (in_array($paymentstatus, explode(',', $paymentstatuss))) {
            return true;
        }
        return false;
    }

    public function isPayment()
    {
        $configValue = $this->scopeConfig->getValue(
            self::RESTRICTPAYMENTBYSHIP_GENRAL_PAYMENT,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->_storeManager->getStore()
        );
        return $configValue;
    }
}
