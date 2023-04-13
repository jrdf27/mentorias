<?php
namespace Mageplaza\HelloWorld\Api; 
interface CustomOrderAttribute
{
    /**
     * GET for Post api
     * @api
     * @param string $rfc
     * @return string
     * @param int $backOrder
     * @return int
     */
 
    public function getData($rfc, $backOrder);
}