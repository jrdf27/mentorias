<?php

namespace Mageplaza\HelloWorld\Helper;


use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfig;
use Magento\Store\Model\StoreManagerInterface as StoreManager;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\ScopeInterface;


class EmailConfirmation extends \Magento\Framework\App\Helper\AbstractHelper
{
    const ID_TEMPLATE_PICKUP = "sendmail_custom/nodo_sendmail/id_email_template";
    
    protected $inlineTranslation;
    protected $escaper;
    protected $transportBuilder;
    protected $logger;
    protected $scopeConfig;
    protected $storeManager;

    public function __construct(StateInterface $inLineTranslation,
           Escaper $escaper,
           TransportBuilder $transportBuilder,
           ScopeConfig $scopeConfig,
           StoreManager $storeManager,
           Context $context             
    )
    {
        $this->inlineTranslation = $inLineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        parent::__construct($context);

    }

    public function sendEmail($order)
    {
       
        $logger = $this->getLogger();
        $logger->info(print_r("Entro a la función sendEmail! ", true));
        $idTemplatePickup = $this->scopeConfig->getValue(
            self::ID_TEMPLATE_PICKUP,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

       $email =  $order->getCustomerEmail();   
        $storeScope = ScopeInterface::SCOPE_STORE;
        $sender = [
            'name' => $this->escaper->escapeHtml('TITLE MESSAGE TEST'),
            'email' => $this->escaper->escapeHtml('jrdf27@gmail.com'),
        ];
        $storeId = $this->storeManager->getStore()->getId();
        $this->inlineTranslation->suspend();
        try {
            $logger->info(print_r("Entro al Try!. ".$email, true));
            $transport = $this->transportBuilder->setTemplateIdentifier($idTemplatePickup)
             ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store'=> $storeId]
             )->setTemplateVars(
                [
                    'title' => 'Mentorias 3Dadv',
                    'subtitle' => 'Details Order',
                    'orderId' => $order->getRealOrderId(),
                    'itemsCollection' => $order->getItemsCollection(),
                    'billingAddress' => $order->getBillingAddress(),
                    'totalDue' => $order->getTotalDue(),
                    'statusHistory' => $order->getVisibleStatusHistory(),
                    'customerId' => $order->getCustomerId(),
                    'customerEmail' => $order->getCustomerEmail(),
                    'customerFirstName' => $order->getCustomerFirstName(),
                    'customerLastName' => $order->getCustomerLastName()
                ]
             )
             ->setFrom($sender)
             ->addTo('c.basicas@itelsalto.edu.mx')
             ->getTransport();
        $transport->sendMessage();
        } catch (\Exception $e) {
            $logger->info(print_r("Error ".$e->getMessage(), true));
        }


        
        $this->inlineTranslation->resume();
        

    }


    public function getLogger(){
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/observer_email.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);

        return $logger;
    }


    
}