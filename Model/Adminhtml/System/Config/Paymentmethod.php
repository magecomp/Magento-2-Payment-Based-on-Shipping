<?php

namespace Magecomp\Restrictpaymentbyship\Model\Adminhtml\System\Config;
class Paymentmethod extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_appConfigScopeConfigInterface;
    protected $_paymentModelConfig;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $appConfigScopeConfigInterface,
                                \Magento\Payment\Model\Config $paymentModelConfig)
    {

        $this->_appConfigScopeConfigInterface = $appConfigScopeConfigInterface;
        $this->_paymentModelConfig = $paymentModelConfig;
    }

    public function getAllOptions()
    {
        $payments = $this->_paymentModelConfig->getActiveMethods();
        $methods = array();
        foreach ($payments as $paymentCode => $paymentModel) {
            $paymentTitle = $this->_appConfigScopeConfigInterface
                ->getValue('payment/' . $paymentCode . '/title');
            $methods[$paymentCode] = array(
                'label' => $paymentTitle,
                'value' => $paymentCode
            );
        }
        return $methods;
    }
}
