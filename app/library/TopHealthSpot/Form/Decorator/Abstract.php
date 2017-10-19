<?php
class TopHealthSpot_Form_Decorator_Abstract
{
	protected $_general;
	protected $_checkbox;
	protected $_hidden;
	protected $_file;
	protected $_jQuery;
	protected $_button;
	protected $_form;
	
	public function apply(Default_Form_Abstract $form)
	{
		if( $this->_general != null && (count($form->getGeneralElements()) > 0)  ) $form->setElementDecorators($this->_general, $form->getGeneralElements());
		if( $this->_checkbox != null && (count($form->getCheckboxElements()) > 0)  ) $form->setElementDecorators($this->_checkbox, $form->getCheckboxElements());
		if( $this->_hidden != null && (count($form->getHiddenElements()) > 0)   ) $form->setElementDecorators($this->_hidden, $form->getHiddenElements());
		if( $this->_file != null && (count($form->getFileElements()) > 0)  ) $form->setElementDecorators($this->_file, $form->getFileElements());
		if( $this->_jQuery != null && (count($form->getJQueryElements()) > 0)   ) $form->setElementDecorators($this->_jQuery, $form->getJQueryElements());
		if( $this->_button != null && (count($form->getButtonElements()) > 0)   ) $form->setElementDecorators($this->_button, $form->getButtonElements());	
		if( $this->_form != null  ) $form->setDecorators($this->_form);	
	}
}