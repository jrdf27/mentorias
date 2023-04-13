<?php
namespace Mageplaza\HelloWorld\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class GetOrders extends AbstractHelper
{    
    protected $orderRepository;
    protected $orderFilter;

    protected $orderCollectionFactory;

    
   
    public function __construct(
        
        CollectionFactory $orderCollectionFactory
    ) {
        
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    public function getOrders()
    {
        $orderCollection = $this->orderCollectionFactory->create();
        $orderCollection->addAttributeToSelect('*');
        $orderCollection->addFieldToFilter('status', ['in' => ['pending', 'processing']]);
       
        return $orderCollection;
    }


    public function changeStatus($order){
        $logger = $this->getLogger();
        //$logger->info(print_r("Dentro del método que cambia el status de la orden!".$order , true));
       
$token = "eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjIsInV0eXBpZCI6MiwiaWF0IjoxNjgxMzQzMzE4LCJleHAiOjE2ODEzNDY5MTh9.B3ZvXKzqI54vgaUa9qyT4WW1t8IF99kiBK_kPa-VC-U";
        $token2 = "1dixmj8l5bsziyjn02y7xmzk39p7p2bj";
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()
        ->get(\Magento\Store\Model\StoreManagerInterface::class);
        $currentUrl = $storeManager->getStore()->getCurrentUrl();

        $substring = strstr($currentUrl, '?', true);

        $currentUrl = $substring;

        $entityId = $order->getEntityId();
        $incrementId = $order->getIncrementId();
        $orderData =
        [
            "entity" => [
                "entity_id" => $entityId,
                "increment_id" => $incrementId,
                "status" => "complete",
                "state" => "processing"
            ]
        ];
        $logger->info(print_r("url ".$currentUrl, true));
        $jsonData = json_encode($orderData);
        
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $currentUrl."/rest/default/V1/orders");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$token));
            $result = json_decode(curl_exec($curl));
            curl_close($curl);
            $logger->info(print_r($result, true));
            return $result;
        } catch (\Exception $e) {
            $logger->info(print_r("Error ".$e->getMessage(), true));
        }
       

    }
    public function saveOrder($order, $orderStatus){
        $order->setStatus($orderStatus);
        $this->orderRepository->save($order);
    }

    public function savelog(){
        $logger = $this->getLogger();
       $orders = $this->getOrders();
      // $logger->info(print_r("Orders ".$orders,true));
        if(!empty($orders)){
            $logger->info(print_r("Dentro del if",true));

            foreach($orders as $order){
                $logger->info(print_r("Actualización de ordenes!" , true));
                $response = $this->changeStatus($order);

                $logger->info(print_r($response, true));
            }
        }
        $logger->info(print_r("Done!",true));

    }

    public function getLogger(): \Zend_log{
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/cron_change_orders.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);

        return $logger;
    }


  
}