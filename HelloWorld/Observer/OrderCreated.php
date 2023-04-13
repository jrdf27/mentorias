<?php
namespace Mageplaza\HelloWorld\Observer;

use Magento\Framework\Event\ObserverInterface;
use Mageplaza\HelloWorld\Helper\Data as Helper;
use Magento\Framework\App\Action\Context;


class OrderCreated implements ObserverInterface
{
    
    protected $helper;
    protected $logger;

    public function __construct(\Magento\Framework\App\Helper\Context $context, Helper $helper)
    {
        
        $this->helper = $helper;
    }


    /**
     * @param Observer $observer
     * @return void
     */

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $customer = $order->getData();

        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/myobserver_order.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);

        $logger->info(json_encode($writer));

        //Guardar los datos en la tabla creada en el CRUD
        $name = $customer['customer_firstname'];
        $url_key = $customer['customer_lastname'];
        $email_customer = $customer['customer_email'];

        $this->helper->saveNewCustomer($name, $url_key,$email_customer);


    }
}