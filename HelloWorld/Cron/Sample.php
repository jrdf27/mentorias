<?php
 
namespace Mageplaza\HelloWorld\Cron;

use Mageplaza\HelloWorld\Helper\GetOrders;

 
class Sample 
{
 
    protected $helper;

    public function __construct(
        GeTOrders $helper
    ) {
        $this->helper = $helper;
        
    }
    public function execute()
    {
        
        $logger = $this->getLogger();
        $logger->info(print_r("Cron it´s works!",true));
        $this->helper->savelog();
    }
    

    public function getLogger(){
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/update_orders.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
 
        return $logger;
    }
 
}