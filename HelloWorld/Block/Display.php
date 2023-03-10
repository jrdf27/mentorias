<?php
namespace Mageplaza\HelloWorld\Block;

use Mageplaza\HelloWorld\Helper\Data  as Helper;
class Display extends \Magento\Framework\View\Element\Template
{
	protected $_postFactory;

	protected $helper;
	protected $request;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Mageplaza\HelloWorld\Model\PostFactory $postFactory,
		Helper $helper
	)
	{
		$this->_postFactory = $postFactory;
		parent::__construct($context);
		$this->helper = $helper;
		$this->request = $context->getRequest();
	}

	public function sayHello()
	{
		return $this->helper->myHelperFunction();
	}

	public function getPostCollection($idCustom){

		$id = $this->request->getParam('id');
		$post = $this->_postFactory->create();
		return $post->getCollection()->addFieldToFilter('post_id',);
	}

	public function migrateOldDataToNewTable(){

		return $this->helper->migrateOldDataToNewTable();
	}
}
