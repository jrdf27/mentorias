<?php
namespace Mageplaza\HelloWorld\Plugin;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderManagementInterface;
use Magento\Sales\Model\Order;

class OrderManagement
{

    protected $productRepository;

    public function __construct(\Magento\Catalog\Model\ProductRepository $productRepository)
    {
     $this->productRepository = $productRepository;
    }
    
    /**
     * @param OrderManagementInterface $subject
     * @param OrderInterface           $order
     *
     * @return OrderInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
  
    public function afterPlace(
        OrderManagementInterface $subject,
        OrderInterface $result
    ){
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/orderManagement.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        try {
            $orderId = $result->getIncrementId();
       
            $logger->info('EN EL PLUGIN DE ORDERMANAGEMENT: ');
          
    
            $items = $result->getAllItems();
    
            foreach($items as $item){
                $productSku = $item->getSku();
                $product = $this->productRepository->get($productSku);
               
                if($product->getData('attribute_type')== 'tipo b'){
    
                    $logger->info("OBTENIENDO Los items");
                    $item->setRowTotal(1700);
                    $item->setBaseRowTotal(1800);
                    $item->setRowInvoiced(1900);
                    $item->setBaseRowInvoiced(2000);
                    $item->save();
                }
            }
    
            return $result;
        } catch (\Exception $e) {
            $logger->info("Error: ".$e->getMessage());
        }
       




    }
    
}

?>