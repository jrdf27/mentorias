<?php
namespace Mageplaza\HelloWorld\Model\ResourceModel\NewCustomer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'post_id';
	protected $_eventPrefix = 'mageplaza_helloworld_new_custom_table_collection';
	protected $_eventObject = 'new_custom_table_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Mageplaza\HelloWorld\Model\NewCustomer', 'Mageplaza\HelloWorld\Model\ResourceModel\NewCustomer');
	}

}
