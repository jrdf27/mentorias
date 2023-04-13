<?php
namespace Mageplaza\HelloWorld\Api; 
/**
 * @api
 */
interface ProductInterface
{
    /**
     * Get customers by email 
     * 
     * @param string $id
     * @return array
     */
 
    
    public function getProduct($id);
}