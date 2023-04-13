<?php

namespace Mageplaza\HelloWorld\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Customer;
use Magento\Setup\Model\ConfigOptionsList\Session;
use Mageplaza\HelloWorld\Api\CustomEmailInterface;
use Mageplaza\HelloWorld\Api\CustomOrderAttribute;

class OrderLoadAfter implements ObserverInterface
{

    
    protected $orderExtension;
    protected $customerSession;
    protected $modelCustomer;


    public function __construct(
        Customer $modelCustomer)
    {
        
        $this->modelCustomer = $modelCustomer;
    } 
    
    public function execute(Observer $observer)
    {
        $this->logs("ENTRO EN LA FUNCIÓN execute del observer test1",'');
        $order = $observer->getOrder();
        $customerId = $order->getCustomerId();
        $extensionAttributes = $order->getExtesionAttributes();

        if($extensionAttributes === null)
        {
            $extensionAttributes = $this->getOrderExtensionDependency();
        }

        $customer = $this->modelCustomer->load($customerId);
        $customerData = $customer->getDataModel();

        $customerRfc = '';
        if($rfc = $customerData->getCustomAttribute('rfc'))
        {
            $customerRfc = $rfc->getValue();
        }

        $customerBackOrder = 0;
        if($backIdOrder = $customerData->getCustomAttribute('back_order')){
            $customerBackOrder = $backIdOrder->getValue();
        }

        $this->logs("OBTENIENDO EL VALOR DEL RFC",$customerRfc);

        $this->logs("OBTENIENDO EL VALOR DEL back_order",$customerBackOrder);

        $extensionAttributes->setData('rfc',$customerRfc);
        $extensionAttributes->setData('back_order',$customerBackOrder);

        $order->setExtensionAttributes($extensionAttributes);


      
    }


    private function getOrderExtensionDependency()
    {
        $orderExtension = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Sales\Api\Data\OrderExtension');

        return $orderExtension;
    }

    private function logs($line, $x)
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/observerAtributte.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info($line .'->'.print_r($x,true));
    }

   

}

