<?php
/**
 * Copyright © . All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Mageplaza\HelloWorld\Block\Customer;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Session;

class Invoice extends Template
{
    /** @var Session */
    protected $session;

    /**     
     * @param Session $session
     * @param Context  $context
     * @param array $data     
     */
    public function __construct(
        Session $session,
        Context $context,
        array $data = []
    ) {
        $this->session = $session;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getCustomer()
    {
        return $this->session->getCustomerDataObject();        
    }

    /**
     * @param string $key     
     * @return string
     */
    public function getCustomAttribute($key)
    {        
        return $this->getCustomer()->getCustomAttribute($key) ? 
               $this->getCustomer()->getCustomAttribute($key)->getValue() : '';
        return 'test2';
    }
}