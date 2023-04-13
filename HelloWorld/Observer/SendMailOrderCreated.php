<?php

namespace Mageplaza\HelloWorld\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


use Mageplaza\HelloWorld\Helper\EmailConfirmation as Helper;

class SendMailOrderCreated implements ObserverInterface
{
    protected $scopeConfig;
    protected $storeManager;
    protected $helper;

    public function __construct(
        Helper $helper
    )
    {
        $this->helper = $helper;
    }

    /**
     * 
     * @param Observer $observer
     * @return void
     */

     public function execute(Observer $observer )
     {
        $logger = $this->getLogger();
        $order = $observer->getEvent()->getOrder();
        $this->helper->sendEmail($order);
        $logger->info(print_r("ORDER DONE!", true));
    
     }

     public function getLogger()
     {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/observer_email.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);

        return $logger;
     }
}
