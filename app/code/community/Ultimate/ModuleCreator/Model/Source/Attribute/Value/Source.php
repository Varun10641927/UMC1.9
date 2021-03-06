<?php
/**
 * Ultimate_ModuleCreator extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE_UMC.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category       Ultimate
 * @package        Ultimate_ModuleCreator
 * @copyright      Copyright (c) 2013
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 * @author         Marius Strajeru <ultimate.module.creator@gmail.com>
 */
/**
 * allowed attribute sources
 *
 * @category    Ultimate
 * @package     Ultimate_ModuleCreator
 * @author      Marius Strajeru <ultimate.module.creator@gmail.com>
 */
class Ultimate_ModuleCreator_Model_Source_Attribute_Value_Source {
    /**
     * source constants
     */
//    const CUSTOM    = 'custom';
//    const PRODUCT   = 'catalog_product';
//    const CATEGORY  = 'catalog_category';
//    const CUSTOMER  = 'customer';
    /**
     * options
     * @var mixed
     */
    protected $_options = null;

    /**
     * get options array
     * @access public
     * @param bool $withEmpty
     * @return array|null
     * @author Marius Strajeru <ultimate.module.creator@gmail.com>
     */
    public function toArray($withEmpty = false) {
        if (is_null($this->_options)) {
            $options = Mage::helper('modulecreator')->getDropdownSubtypes(true);
            $this->_options = array();
            foreach ($options as $key=>$option){
                $this->_options[$key] = $option->label;
            }
        }
        $options = $this->_options;
        if ($withEmpty) {
            $options = array_merge(array(''=>''), $options);
        }
        return $options;
    }
}
