<?php
class Default_Form_Admin_Content extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'contentID',
								'name',
								'pageTitle',	
								'description',
								'metaDescription',
								'metaKeywords',
								'contentIdDisplay'
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
						
		$this->addElement($this->createElement('text','name')->setLabel("Name")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(2));	

		$this->addElement($this->createElement('text','pageTitle')->setLabel("Page Title")
						->setRequired(false)->addFilter(new Zend_Filter_StringTrim())->setOrder(3));	
						
						
		$this->addElement('tinyMce', 'description', array(
		    'label'      => 'Description',
			'required'   => false,
		    'cols'       => '25',
		    'rows'       => '10',
		    'editorOptions' => new Zend_Config_Ini(APPLICATION_PATH . '/../config/tinymce.ini', 'editor'),
			'order'		=> '4'
		));						
		
		$this->addElement($this->createElement('textarea','metaKeywords')->setLabel("Meta Keywords")->setOrder(11)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','metaDescription')->setLabel("Meta Description")->setOrder(12)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Save Content')->setOrder(99));
	}
	
	public function makeEdit($id)
	{
		$this->addElement($this->createElement('plainText','contentIdDisplay')
							->setLabel("Content ID")->setValue($id)->setOrder(1));
								
		$this->addElement($this->createElement('hidden','contentID')->setRequired(true));
		$this->applyDecoratorPackage();
	}
}
?>