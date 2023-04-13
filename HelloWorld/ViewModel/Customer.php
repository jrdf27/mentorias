<?php

declare(strict_types=1);

namespace Mageplaza\HelloWorld\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;



class Customer implements ArgumentInterface
{
    
    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;
    /**
     * @param \Magento\Catalog\Model\CustomerFactory     $customerFactory
     */
    public function __construct(
      
    ){
        
    }

    public function getCustomerByRfc($rfc) {
        $customerObj = $this->customerFactory->create()->load($rfc);
        
        
        return "Add from view model";

    }

    public function getCustomAttribute($rfc){

        return 0;
    }

    public function getMessage($x)
    {
       if($x == null){
            return "1";
       }else{
        return 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime.';
    }
       } 
        
} 