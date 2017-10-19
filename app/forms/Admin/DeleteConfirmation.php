<?php
class Default_Form_Admin_DeleteConfirmation extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
	);

	protected $_fileElements = array(
								'bannerFile'
	);
	
	protected $_buttonElements = array(
									'submit'
	);
	                   
	public function init()
	{	
		parent::init();	
		$this->setMethod('post');
		
		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Delete')->setOrder(99));
	}
}
?>