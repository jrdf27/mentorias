<?php
namespace Mageplaza\HelloWorld\Model;
class NewCustomer extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'new_custom_table';

	protected $_cacheTag = 'new_custom_table';

	protected $_eventPrefix = 'new_custom_table';

	protected function _construct()
	{
		$this->_init('Mageplaza\HelloWorld\Model\ResourceModel\NewCustomer');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}