<?php

namespace Mageplaza\HelloWorld\Helper;

use Magento\Framework\App\Helper\AbstractHelper;


use Mageplaza\HelloWorld\Model\PostFactory;
use Mageplaza\HelloWorld\Model\NewCustomerFactory;
use Magento\Framework\Controller\Result\JsonFactory;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Mageplaza\HelloWorld\Model\ResourceModel\NewCustomTable;


class Data extends AbstractHelper
{
  protected $_collection;

  protected $_myTableFactory;

  protected $jsonResultFactory;
  protected $myTableFactory2;

  protected $_newCustomerFactory;

  protected $_customerCollectionFactory;
  protected $_newCustomerCollectionFactory;

  protected $customerFactory;


  public function __construct(
    \Magento\Framework\App\Helper\Context $context,
    \Mageplaza\HelloWorld\Model\ResourceModel\Post\CollectionFactory $customerFactory,
    PostFactory $myTableFactory,
    NewCustomerFactory $myTableFactory2,
    NewCustomerFactory $newCustomerFactory,
    JsonFactory $jsonResultFactory
  )
  {

    parent::__construct($context);


    

    $this->_myTableFactory = $myTableFactory;
    $this->myTableFactory2 = $myTableFactory2;
    $this->_customerCollectionFactory = $customerFactory;
    $this->_newCustomerFactory = $newCustomerFactory;
    $this->_jsonResultFactory = $jsonResultFactory;

  }


  public function myHelperFunction()
  {
    // Obtener instancia del modelo
    $myTableModel = $this->myTableFactory2->create();
   // $oldTable2 = $this->myTableFactory->create();
   
    //$sourceData = $oldTable2->getCollection()->getData();
    //$sourceData = $oldTable2;
   
   // foreach($sourceData as $data) {
      // Usar set() para guardar valores en cada campo

       
      // $myTableModel = $this->myTableFactory2->create();
      //$myTableModel->setData($data);
      // $myTableModel->setName($oldTable2->getName('name'));
      // $myTableModel->setData('url_key',$data->getData('url_key'));
       //$myTableModel->setData('email_customer',$data->getData('email_customer'));

      // Guardar valores en la tabla utilizando save()
      $myTableModel->save();
 //   }
    // Retornar un mensaje
    return 'Datos guardados en la tabla correctamente';
  }

  public function getPostCollection($idCustom){

    $resultJson = $this->_jsonResultFactory->create();
    
		$post = $this->_myTableFactory->create();
		$data= $post->getCollection()->addFieldToFilter('post_id',$idCustom);
    return $resultJson->setData($data);
	}

  public function migrateOldDataToNewTable()
  {
    // crear archivo log 
    $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/getcitylist.log');
    $logger = new \Zend_Log();
    $logger->addWriter($writer);

    $logger->info('dentro del helper');

    $myTableModel = $this->_customerCollectionFactory->create();


    //$newModel = $this->myTableFactory2->create();

    try {

      foreach ($myTableModel as $originalModel) {

        $logger->info('post_id: ' . $originalModel->getData('post_id'));
       
        $newModel= $this->_newCustomerFactory->create();
      
        $newModel->setName($originalModel->getName());
        $newModel->setUrlKey($originalModel->getUrlKey());
        $newModel->setEmailCustomer($originalModel->getEmailCustomer());
        $newModel->save();

      }
      return   "";
    } catch (\Exception $e) {
      $logger->info('ERROR:' . $e->getMessage());
    }

    
  }





}