<?php
class Default_Form_Admin_Page extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'categoryID',
								'subCategoryID',
								'articleTitle',
								'price',
								'description',
								'pageTitle',
								'metaDescription',
								'metaKeywords',
								'pageIdDisplay'
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
		
		$this->addElement($this->createElement('text','articleTitle')->setLabel("Article Title")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim()));	
						
						
		$category = new Default_Model_Category();
		$this->addElement($this->createElement('select','categoryID')->setLabel("Parent Category")->setRequired(true)
						->addMultiOption(array(''=>'Select a Category'))->addMultiOptions($category->fetchAllAsArray())
						->addFilter(new Zend_Filter_StringTrim()));	
		
		$this->addElement($this->createElement('select','subCategoryID')->setLabel("Sub Category")->setRequired(true)
						->setMultiOptions($arr = array( '' => 'Select Sub Category' ))
						);	
						
						
		$this->addElement($this->createElement('text','price')->setLabel("Price")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim()));	
						
		$this->addElement('tinyMce', 'description', array(
		    'label'      => 'Description',
			'required'   => true,
		    'cols'       => '25',
		    'rows'       => '10',
		    'editorOptions' => new Zend_Config_Ini(APPLICATION_PATH . '/../config/tinymce.ini', 'editor')
		));						
						
		$this->addElement($this->createElement('text','pageTitle')->setLabel("Page Title")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim()));	
		
		$this->addElement($this->createElement('textarea','metaKeywords')->setLabel("Meta Keywords")
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','metaDescription')->setLabel("Meta Description")
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	
												
		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Save Page'));
	}
	
	public function makeEdit($id)
	{
		$elements = $this->getElements();
		$tmp = array( 'pageIdDisplay' => $this->createElement('plainText','pageIdDisplay')
							->setLabel("Page ID")->setValue($id) );
		
		$elements = array_merge($tmp, $elements);
		
		$elements['pageID'] = $this->createElement('hidden','pageID')
						->setRequired(true);

		$this->setElements($elements);
		$this->applyDecoratorPackage();
	}
}
?>