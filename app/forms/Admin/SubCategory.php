<?php
class Default_Form_Admin_SubCategory extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'categoryID',
								'name',
								'description',
								'pageTitle',
								'metaDescription',
								'metaKeywords',
								'details',
								'subCategoryIdDisplay'
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
		
		$this->addElement($this->createElement('text','name')->setLabel("Sub Category Name")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(2));	
						
						
		$category = new Default_Model_Category();
		$this->addElement($this->createElement('select','categoryID')->setLabel("Parent Category")->setOrder(3)
						->setRequired(true)->setMultiOptions($category->fetchAllAsArray())->addFilter(new Zend_Filter_StringTrim()));	
						
		$this->addElement($this->createElement('text','pageTitle')->setLabel("Page Title")->setOrder(4)
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim()));	
						
		$this->addElement($this->createElement('textarea','metaKeywords')->setLabel("Meta Keywords")->setOrder(5)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','metaDescription')->setLabel("Meta Description")->setOrder(6)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','details')->setLabel("Details")->setOrder(8)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	
						
		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Save Sub Category')->setOrder(99));
	}
	
	public function makeEdit($id)
	{
		$this->addElement($this->createElement('plainText','subCategoryIdDisplay')->setLabel("Sub Category ID")->setRequired(false)->setValue($id)->setOrder(1));
		$this->addElement($this->createElement('hidden','subCategoryID')->setRequired(true)->setValue($id));
		$this->applyDecoratorPackage();		
		
		
	}
}
?>