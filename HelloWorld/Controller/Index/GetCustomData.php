<?php
namespace Mageplaza\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Mageplaza\HelloWorld\Model\PostFactory;
use Mageplaza\HelloWorld\Helper\Data;

class GetCustomData extends \Magento\Framework\App\Action\Action
{
    protected $resultJsonFactory;
    protected $request;

    
    protected $_postFactory;
    protected $helperData;

    protected $jsonResultFactory;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        PostFactory $postFactory,
        Data $helperData,
        JsonFactory $jsonResultFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
        $this->request = $context->getRequest();
        $this->_postFactory = $postFactory;
        $this->helperData = $helperData;
        $this->jsonResultFactory = $jsonResultFactory;

    }

    public function execute()
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/getcitylist.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
    
        $logger->info('dentro del Controller');
        $response = ['message' => 'Hello from GetCustomData controller!'];
        $resultJson = $this->resultJsonFactory->create();
       
        $id = $this->request->getParam('id');

        $resp = $this->helperData->getPostCollection($id);

        return $resultJson->setData($resp);

        
	}

  
}

