<?php

namespace Mageplaza\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;

class NewCustomTable extends AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    protected function _construct()
    {
        $this->_init('Mageplaza\HelloWorld\Model\ResourceModel\NewCustomTable');
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
