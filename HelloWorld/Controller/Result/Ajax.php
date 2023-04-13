<?php

namespace Mageplaza\HelloWorld\Controller\Result;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Mageplaza\HelloWorld\Model\PostFactory;
use Magento\Framework\View\Result\PageFactory;

class Ajax extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory;
     */
    protected $jsonFactory;

    protected $resultPageFactory;
    protected $model;
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        PageFactory $resultPageFactory,
        PostFactory $model
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->model = $model;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
           
            $result = $this->jsonFactory->create();
            $resultPage = $this->resultPageFactory->create();

            $block = $resultPage->getLayout()
                ->createBlock('Mageplaza\HelloWorld\Block\Display')
                ->setTemplate('Mageplaza_HelloWorld::resultconsul.phtml')
                ->setData('id',$id)
                ->toHtml();

            $result->setData(['output' => $block]);
            return $result;      

    }
}