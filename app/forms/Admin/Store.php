<?php
class Default_Form_Admin_Store extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'name',
								'description',
								'secondarydescription',
								'pageTitle',
								'metaDescription',
								'metaKeywords',
								'url',
								'video',
								'storeIdDisplay'
	);
	protected $_fileElements = array(
								'storelogo',
								'storescreenshot'
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
		
		$this->addElement($this->createElement('text','name')->setLabel("Name")->setOrder(2)
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim()));	
									
		$this->addElement('tinyMce', 'description', array(
		    'label'      => 'Description',
			'required'   => false,
		    'cols'       => '25',
		    'rows'       => '10',
		    'editorOptions' => new Zend_Config_Ini(APPLICATION_PATH . '/../config/tinymce.ini', 'editor'),
			'order'		 => '3'
		));

		$this->addElement($this->createElement('textarea','secondarydescription')->setLabel("Secondary Description")->setOrder(4)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	
						
		$this->addElement($this->createElement('text','pageTitle')->setLabel("Page Title")->setOrder(5)
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('text','url')->setLabel("URL")->setOrder(6)->setRequired(true));					

		$this->addElement($this->createElement('text','video')->setLabel("Video URL")->setOrder(7)->setRequired(false));					

		$this->addElement($this->createElement('textarea','metaKeywords')->setLabel("Meta Keywords")->setOrder(8)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','metaDescription')->setLabel("Meta Description")->setOrder(9)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('file','storelogo')->setLabel("Store Logo")->setOrder(10)->setRequired(true));

		$this->addElement($this->createElement('file','storescreenshot')->setLabel("Store Screenshot")->setOrder(11)->setRequired(true));	
				
		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Save Store')->setOrder(99));
	}
	
	public function makeEdit($id)
	{

		$this->addElement($this->createElement('plainText','storeIdDisplay')->setLabel("Store ID")->setOrder(1)->setValue($id));

		if (file_exists(DOCROOT_PATH . '/assets/images/store-logos/' . $id . '.jpg')) {
			$this->removeElement('storelogo');
			$this->addElement($this->createElement('file','storelogo')->setLabel("Store Logo")->setOrder(10)->setRequired(false));
		}
		
		if (file_exists(DOCROOT_PATH . '/assets/images/store-screenshots/' . $id . '.gif')) {
			$this->removeElement('storescreenshot');
			$this->addElement($this->createElement('file','storescreenshot')->setLabel("Store Screenshot")->setOrder(11)->setRequired(false));
		}
		
		$this->addElement($this->createElement('hidden','storeID')->setRequired(true));
		$this->applyDecoratorPackage();

	}
}
?>