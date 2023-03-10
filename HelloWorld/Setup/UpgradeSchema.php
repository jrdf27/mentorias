<?php
namespace Mageplaza\HelloWorld\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    { 
        $setup->startSetup();
 
        if (version_compare($context->getVersion(), '1.1.8', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable(' ce'),
                'email_customer',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => false,
                    'comment' => 'Email Costumer'
                ]
            );
        }
 
        $setup->endSetup();
    }
}