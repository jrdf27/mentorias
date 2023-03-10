<?php
namespace Mageplaza\HelloWorld\Model\ResourceModel;


class NewCustomer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('new_custom_table', 'post_id');
	}
	
}