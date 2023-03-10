<?php

namespace Mageplaza\HelloWorld\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class NewCustomTable extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('new_custom_table', 'post_id');
    }
}
