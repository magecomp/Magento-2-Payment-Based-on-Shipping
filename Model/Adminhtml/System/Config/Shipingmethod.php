<?php

namespace Magecomp\Restrictpaymentbyship\Model\Adminhtml\System\Config;
class Shipingmethod extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $scopeConfig;
    protected $shipment;

    public function __construct(\Magento\Shipping\Model\Config $shippingmodelconfig, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        $this->shipment = $shippingmodelconfig;
    }

    public function getAllOptions()
    {
        $shippings = $this->shipment->getActiveCarriers();
        $methods = array();
        foreach ($shippings as $shippingCode => $shippingModel) {
            if ($carrierMethods = $shippingModel->getAllowedMethods()) {
                foreach ($carrierMethods as $methodCode => $method) {
                    $code = $shippingCode . '_' . $methodCode;
                    $carrierTitle = $this->scopeConfig->getValue('carriers/' . $shippingCode . '/title');
                    $methods[] = array('value' => $code, 'label' => $carrierTitle);
                }
            }
        }
        return $methods;
    }
}
