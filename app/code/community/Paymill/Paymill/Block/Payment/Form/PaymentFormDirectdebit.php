<?php

/**
 * Magento
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Open Software License (OSL 3.0)  
 * that is bundled with this package in the file LICENSE.txt.  
 * It is also available through the world-wide-web at this URL:  
 * http://opensource.org/licenses/osl-3.0.php  
 * If you did not receive a copy of the license and are unable to  
 * obtain it through the world-wide-web, please send an email  
 * to license@magentocommerce.com so we can send you a copy immediately.  
 * 
 * @category Paymill  
 * @package Paymill_Paymill  
 * @copyright Copyright (c) 2013 PAYMILL GmbH (https://paymill.com/en-gb/)  
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)  
 */
class Paymill_Paymill_Block_Payment_Form_PaymentFormDirectdebit extends Paymill_Paymill_Block_Payment_Form_PaymentFormAbstract
{

    /**
     * Construct
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('paymill/payment/form/directdebit.phtml');
    }
    
    public function getPaymentData($code)
    {
        $payment = parent::getPaymentData($code);
        
        $data = array();
        if (!is_null($payment)) {
            $data['holder'] = $payment['holder'];
            if (array_key_exists('code', $payment) && array_key_exists('account', $payment)) {
                $data['code'] = $payment['code'];
                $data['account'] = $payment['account'];
            } elseif (array_key_exists('iban', $payment) && array_key_exists('bic', $payment)) {
                $data['bic'] = $payment['bic'];
                $data['iban'] = $payment['iban'];
            }
        }
        
        return $data;
    }
    
    public function isSepa()
    {
        return Mage::getStoreConfig('payment/paymill_directdebit/sepa', Mage::app()->getStore()->getStoreId()) ? 'true' : 'false';
    }
}
