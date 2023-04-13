<?php
namespace Mageplaza\HelloWorld\Model\Config\Product;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Extensionoption extends AbstractSource
{
   /**
    *  @return array
     */

    public function getAllOptions()
    {  
        if(null === $this->_options){
            $this->_options = [
                ['label' => __('Tipo A'), 'value'=> 'tipo a'],
                ['label' => __('Tipo B'), 'value'=> 'tipo b'],
            ];
           
        }
        

        return $this->_options;
    }
}