<?php
namespace Mageplaza\HelloWorld\Block;
use Magento\Framework\UrlInterface;

use Mageplaza\HelloWorld\Helper\Data  as Helper;
class Display extends \Magento\Framework\View\Element\Template
{
	protected $_postFactory;

	protected $helper;
	protected $request;

	protected $_urlBuilder;


	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Mageplaza\HelloWorld\Model\PostFactory $postFactory,
		Helper $helper,
		UrlInterface $urlBuilder
	)
	{
		$this->_postFactory = $postFactory;
		parent::__construct($context);
		$this->helper = $helper;
		$this->request = $context->getRequest();
		$this->_urlBuilder = $urlBuilder;
	}

	public function sayHello($id)
	{
		//return $this->helper->getCollection($id);
	}

	public function getPostCollection(){

		$id = $this->getRequest()->getParam('id');
		//$id = $this->request->getParam('id');
		$post = $this->_postFactory->create();
		
		if($post->getCollection()->addFieldToFilter('post_id',$id)->getsize() == 0){
			$registro = "0";
		}else{
			$registro = $post->getCollection()->addFieldToFilter('post_id',$id);
		}

		return $registro;
	}

	public function migrateOldDataToNewTable(){

		return $this->helper->migrateOldDataToNewTable();
	}


	public function getIdData()
    {
        return $this->getId();
    }
}
