<?php
/**
 * @category   ZExt
 * @package    ZExt_Form
 * @subpackage ZExt_Form_Element
 * @author     Sean P. O. MacCath-Moran
 * @email      zendcode@emanaton.com
 * @website    http://www.emanaton.com
 * @copyright  This work is licenced under a Attribution Non-commercial Share Alike Creative Commons licence
 * @license    http://creativecommons.org/licenses/by-nc-sa/3.0/us/
 *
*/
    
/** Zend_Form_Element_Xhtml */
/*require_once 'Zend/Form/Element/Xhtml.php'; */
    
/**
 * Plain text form element
 *
 * @category   ZExt
 * @package    ZExt_Form
 * @subpackage ZExt_Form_Element
 * @author     Sean P. O. MacCath-Moran
 * @email      zendcode@emanaton.com
 * @website    http://www.emanaton.com
 * @copyright  This work is licenced under a Attribution Non-commercial Share Alike Creative Commons licence
 * @license    http://creativecommons.org/licenses/by-nc-sa/3.0/us/
*/
class ZExt_Form_Element_PlainText extends Zend_Form_Element_Xhtml {
  /**
   * Default form view helper to use for rendering
   * @var string
  */
  public $helper = 'formPlainText';
}
