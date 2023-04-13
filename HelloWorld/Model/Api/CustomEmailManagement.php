<?php 
namespace Mageplaza\HelloWorld\Model\Api;
use Mageplaza\HelloWorld\Api\CustomEmailInterface; 
use Psr\Log\LoggerInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class CustomEmailManagement implements CustomEmailInterface
{
    protected $logger;
    protected $_customerFactory;
    protected $_resultJsonFactory;

    public function __construct(
        LoggerInterface $logger,
        CustomerFactory $customers,
        JsonFactory $resultJsonFactory
    )
    {
        $this->logger = $logger;
        $this->_customerFactory = $customers;
        $this->_resultJsonFactory = $resultJsonFactory;
        
    }
 
    /**
     * @inheritdoc
     */
    public function getCustomer($email)
    {
        
         
        $customer = $this->_customerFactory->create();
        $result = $this->_resultJsonFactory->create();

        $result = $customer->setWebsiteId(1)->loadByEmail($email)->getData();
        

    

        return $result; 
    }
}

    
 


