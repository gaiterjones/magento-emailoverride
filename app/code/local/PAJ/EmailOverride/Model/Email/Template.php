<?php
/**
 * PAJ EmailOverride for Magento 
 *
 * @package     PAJ_EmailOverride
 * @author      PAJ
 * @copyright   Copyright 2015 PAJ
 * @license     Open Source License (OSL v3)
 */


// Allow for an override of Aschroder_SMTPPro_Model_Email_Template
if (Mage::helper('core')->isModuleEnabled('Aschroder_SMTPPro') && class_exists('Aschroder_SMTPPro_Model_Email_Template')) {
    class PAJ_EmailOverride_Model_Email_Template_Wrapper extends Aschroder_SMTPPro_Model_Email_Template {}
}elseif (Mage::helper('core')->isModuleEnabled('Ebizmarts_Mandrill') && class_exists('Ebizmarts_Mandrill_Model_Email_Template')) {
    class PAJ_EmailOverride_Model_Email_Template_Wrapper extends Ebizmarts_Mandrill_Model_Email_Template {}
} else {
    class PAJ_EmailOverride_Model_Email_Template_Wrapper extends Mage_Core_Model_Email_Template {}
}

/**
 * EmailOverride Core model
 */
class PAJ_EmailOverride_Model_Email_Template extends PAJ_EmailOverride_Model_Email_Template_Wrapper
{
    public function setDesignConfig(array $config)
    {
        if(isset($config['store'])) {
            $store = Mage::registry('emailoverride.store');
            if(empty($store)) {
                Mage::register('emailoverride.store', $config['store'], true);
            }
        }
        return parent::setDesignConfig($config);
    }
}
