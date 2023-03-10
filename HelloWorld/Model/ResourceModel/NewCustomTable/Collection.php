<?php

namespace Mageplaza\HelloWorld\Model\ResourceModel\NewCustomTable;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'mageplaza_helloworld_new_custom_table_collection';
    protected $_eventObject = 'new_custom_table_collection';

    protected function _construct()
    {
        $this->_init('mageplaza\helloworld\Model\NewCustomTable', 'mageplaza\helloworld\Model\ResourceModel\NewCustomTable');
    }
}
