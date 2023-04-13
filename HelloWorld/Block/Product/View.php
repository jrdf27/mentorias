<?php
 
namespace Mageplaza\HelloWorld\Block\Product;
 
class View extends \Magento\Catalog\Block\Product\View
{
    /**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        // logging to test override    
        $logger = \Magento\Framework\App\ObjectManager::getInstance()->get('\Psr\Log\LoggerInterface');
        $logger->debug('Block Override Test');
        
        if (!$this->_coreRegistry->registry('product') && $this->getProductId()) {
            $product = $this->productRepository->getById($this->getProductId());
            $this->_coreRegistry->register('product', $product);
        }
        return $this->_coreRegistry->registry('product');
    }

    public function getMsiData($_product, $qnty){
        $price = $this->getProductPrice($_product);
        $priceB = strpos($price, "$")+1;
        $priceE = strpos($price, '"')-1;
        $priceSubs = substr($price,$priceB,$priceE);
        $priceParseDouble =  doubleval($priceSubs);

        return number_format((float)$priceParseDouble/$qnty,2,'.','');
    }
}
?>