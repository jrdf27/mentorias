<?php
namespace Mageplaza\HelloWorld\Api; 
/**
 * @api
 */
interface CustomEmailInterface
{
    /**
     * Get customers by email 
     * 
     * @param string $email
     * @return array
     */
 
    
    public function getCustomer($email);
}