<?php
class Default_Form_Admin_Category extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'name',
								'description',
								'pageTitle',
								'metaDescription',
								'metaKeywords',
								'showInLayout',
								'details',
								'categoryIdDisplay'
	);

	protected $_fileElements = array(
								'headerBannerFile'
	);
	
	protected $_buttonElements = array(
									'submit'
	);
	                   
	public function init()
	{	
		parent::init();	
		$this->setMethod('post');
		
		$this->addPrefixPath('Sozfo_Form_Element', 'Sozfo/Form/Element/', 'element');
		$this->addPrefixPath('ZExt_Form_Element', 'ZExt/Form/Element/', 'element');
		
		$this->addElement($this->createElement('text','name')->setLabel("Category Name")->setOrder(2)
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim()));	
									
		$this->addElement($this->createElement('text','pageTitle')->setLabel("Page Title")->setOrder(3)
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim()));	
						
		$this->addElement($this->createElement('textarea','metaKeywords')->setLabel("Meta Keywords")->setOrder(4)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','metaDescription')->setLabel("Meta Description")->setOrder(5)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('file','headerBannerFile')->setLabel("Header Image")->setOrder(6)->setRequired(false));	
						
		$this->addElement($this->createElement('checkbox','showInLayout')->setLabel("Show In Layout")->setOrder(7));	

		$this->addElement($this->createElement('textarea','details')->setLabel("Details")->setOrder(8)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	
		
		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Save Category')->setOrder(99));
	}
	
	public function makeEdit($id)
	{
		$this->addElement($this->createElement('plainText','categoryIdDisplay')->setLabel("Category ID")->setRequired(false)->setValue($id)->setOrder(1));
		$this->addElement($this->createElement('hidden','categoryID')->setRequired(true)->setValue($id));
		$this->applyDecoratorPackage();		


	}
}
?>