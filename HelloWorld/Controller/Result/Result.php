<?php

namespace Mageplaza\HelloWorld\Controller\Result;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class Result extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory;
     */
    protected $resultPageFactory;

    protected $resultJsonFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */

     public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory)
        {
            $this->resultPageFactory = $resultPageFactory;
            $this->resultJsonFactory = $resultJsonFactory;
            return parent::__construct($context);
        }

        public function execute(){
            $numone = $this->getRequest()->getParam('numone');
            $numtwo = $this->getRequest()->getParam('numtwo');

            $id= $this->getRequest()->getParam('id');

            $result = $this->resultJsonFactory->create();
            $resultPage = $this->resultPageFactory->create();

            $block = $resultPage->getLayout()
                ->createBlock('Mageplaza\HelloWorld\Block\Index')
                ->setTemplate('Mageplaza_HelloWorld::resultconsul.phtml')
                ->setData('numone',$numone)
                ->setData('numtwo',$numtwo)
                ->setData('id',$id)
                ->toHtml();

            $result->setData(['output' => $block]);
            return $result;    
        }
}