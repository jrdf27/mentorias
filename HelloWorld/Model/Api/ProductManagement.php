<?php 
namespace Mageplaza\HelloWorld\Model\Api;
use Mageplaza\HelloWorld\Api\ProductInterface; 
use Psr\Log\LoggerInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Catalog\Model\ResourceModel\ProductFactory;

class ProductManagement implements ProductInterface
{
    protected $logger;
    protected $productFactory;
    protected $_resultJsonFactory;

    protected $productFactory2;

    public function __construct(
        LoggerInterface $logger,
        Product $productFactory,
        JsonFactory $resultJsonFactory,
        ProductFactory $productFactory2
    )
    {
        $this->logger = $logger;
        $this->productFactory = $productFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->productFactory2 = $productFactory2;
        
    }
 
    /**
     * @inheritdoc
     */
    public function getProduct($id)
    {
        
       $productResource = $this->productFactory2->create();
       $productCollection = $productResource->getProduct()->load()->getItems();
       //$productCollection = $productCollection->getItems();
      //$productCollection = $productResource->
       //$productCollection =$this->productFactory->getName();

       $result = $this->_resultJsonFactory->create();

       $result = $productCollection;

       return $result;
    }
}