<?php
class Default_Form_ContactUs extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'name',
								'email',
								'subject',
								'message'
	);
	
	protected $_buttonElements = array(
									'submit'
	);
	                   
	public function init()
	{	
		parent::init();	
		$this->setMethod('post');
		$this->setAttrib('id','emailToFriend');
		
		$this->addPrefixPath('Sozfo_Form_Element', 'Sozfo/Form/Element/', 'element');
		$this->addPrefixPath('ZExt_Form_Element', 'ZExt/Form/Element/', 'element');
		
		$this->addElement($this->createElement('text','name')->setLabel("Name")->setOrder(1)->setRequired(true));
		$this->addElement($this->createElement('text','email')->setLabel("Email")->setOrder(2)->setRequired(true)->addValidator(new Zend_Validate_EmailAddress()));
		$this->addElement($this->createElement('text','subject')->setLabel("Subject")->setOrder(3)->setRequired(false));
		
		$this->addElement($this->createElement('textarea','message')->setLabel("Message")->setOrder(4)->setRequired(false));		
		
		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Send')->setOrder(99));
	}
}
?>