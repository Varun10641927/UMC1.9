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
 * custom attribute dropdown type
 *
 * @category    Ultimate
 * @package     Ultimate_ModuleCreator
 * @author      Marius Strajeru <ultimate.module.creator@gmail.com>
 */
class Ultimate_ModuleCreator_Model_Attribute_Type_Dropdown_Custom
    extends Ultimate_ModuleCreator_Model_Attribute_Type_Dropdown_Abstract {
    /**
     * check if source needs to be generated
     * @access public
     * @return string
     * @author Marius Strajeru <ultimate.module.creator@gmail.com>
     */
    public function getGenerateSource(){
        return $this->getTypeAttribute()->getAttribute()->getEntity()->getIsFlat();
    }
    /**
     * get additional setup values
     * @access public
     * @return string
     * @author Marius Strajeru <ultimate.module.creator@gmail.com>
     */
    public function getAdditionalSetup(){
        $content = '';
        if ($this->getTypeAttribute()->getAttribute()->getEntity()->getIsEav()){
            $padding  = $this->getPadding(6);
            $tab      = $this->getPadding();
            $eol      = $this->getEol();
            if ($this->getTypeAttribute()->getAttribute()->getOptions()) {
                $content .= $padding."'option' =>".$eol;
                $content .= $padding.$tab."array (".$eol;
                $content .= $padding.$tab.$tab."'values' =>".$eol;
                $content .= $padding.$tab.$tab.$tab."array (".$eol;
                foreach ($this->getTypeAttribute()->getAttribute()->getOptions(true) as $option) {
                    $content .= $padding.$tab.$tab.$tab.$tab."'".$option."',".$eol;
                }
                $content .= $padding.$tab.$tab.$tab."),".$eol;
                $content .= $padding.$tab.$tab."),".$eol;
            }
        }
        return $content;
    }
    /**
     * get attribute options for source model
     * @access public
     * @return string
     * @author Marius Strajeru <ultimate.module.creator@gmail.com>
     */
    public function getAttributeOptions(){
        $content = '';
        $padding  = $this->getPadding(2);
        $tab      = $this->getPadding();
        $eol      = $this->getEol();
        $module   = $this->getTypeAttribute()->getAttribute()->getEntity()->getModule()->getLowerModuleName();
        if ($this->getTypeAttribute()->getAttribute()->getOptions()) {
            $content = $padding.'$options =  array('.$eol;
            foreach ($this->getTypeAttribute()->getAttribute()->getOptions(true) as $index=>$option) {
                $content .= $padding.$tab.'array('.$eol;
                $content .= $padding.$tab.$tab."'label' => Mage::helper('".$module."')->__('".$option."'),".$eol;
                $content .= $padding.$tab.$tab."'value' => ".($index+1).$eol;
                $content .= $padding.$tab.'),'.$eol;
            }
            $content .= $padding.");".$eol;
            $content .= $padding.'if ($withEmpty) {'.$eol;
            $content .= $padding.$tab.'array_unshift($options, array(\'label\'=>\'\', \'value\'=>\'\'));'.$eol;
            $content .= $padding.'}'.$eol;
            $content .= $padding.'return $options;'.$eol;
        }
        else {
            $content  = $padding.'return array();';
        }
        return $content;
    }
}