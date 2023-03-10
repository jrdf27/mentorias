<?php
namespace Mageplaza\HelloWorld\Block\Index;
 
use Magento\Framework\View\Element\Template;
 
class View extends Template
{
  public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }
 
  protected function _prepareLayout()
    {
        return parent::_prepareLayout(); 
    }
 
  public function getProducts($productId)
  {
     return;
  }
}