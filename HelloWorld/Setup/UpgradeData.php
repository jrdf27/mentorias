<?php

namespace Mageplaza\HelloWorld\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\FunctionalTestingFramework\Upgrade\UpgradeInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    } 

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), '1.6.8', '<')){
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'attribute_type',
                [
                    'type' => 'text',
                    'input' => 'select',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Attribute Type',
                    'class' => '',
                    'source' => 'Mageplaza\HelloWorld\Model\Config\Product\Extensionoption',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'require' => true,
                    'user_defined'=> false,
                    'default' => '',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing'=> true,
                    'unique' => false,
                    'apply_to' => ''

                ]
            );
        }
    }
}
