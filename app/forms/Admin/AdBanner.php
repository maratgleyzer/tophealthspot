<?php
class Default_Form_Admin_AdBanner extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'categoryID',
								'image',
								'href',
								'height',
								'width',
								'order',
								'primary',
								'adBannerIdDisplay'
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
		
		$this->setDecorators(array('FormElements',
    						 array('HtmlTag', array('tag' => 'li')),
    						 'Form'));
		
		$this->setMethod('post');
		
		$this->addPrefixPath('Sozfo_Form_Element', 'Sozfo/Form/Element/', 'element');
		$this->addPrefixPath('ZExt_Form_Element', 'ZExt/Form/Element/', 'element');
		
		$category = new Default_Model_Category();
		$this->addElement($this->createElement('select','categoryID')->setLabel("Select Category")->setRequired(false)->setOrder(2)
						->addMultiOption('','-Global')->addMultiOptions($category->fetchAllAsArray())
						->addFilter(new Zend_Filter_StringTrim()));	
		
		//$this->addElement($this->createElement('file','bannerFile')->setLabel("Banner Image")->setOrder(6)->setRequired(true));	
		$widths = array(
				  '' => '-- select width --',
				  '100' => '100 pixels',
				  '210' => '210 pixels'
				  );
					
		$heights = array(
				   '' => '-- select height --',
				   '100' => '100 pixels',
				   '210' => '210 pixels',
				   '105' => '105 pixels',
				   '480' => '480 pixels'
				   );	
					
						
		$this->addElement($this->createElement('select','width')->setLabel("Banner Width")
							->addMultiOptions($widths)
							->setOrder(8)->setRequired(true));

		$this->addElement($this->createElement('select','height')->setLabel("Banner Height")
							->addMultiOptions($heights)
							->setOrder(9)->setRequired(true));
							
		$this->addElement($this->createElement('text','image')->setLabel("Image URL")->setOrder(10)->setRequired(true));

		$this->addElement($this->createElement('text','href')->setLabel("Destination")->setOrder(11)->setRequired(true));
			
		$this->addElement($this->createElement('text','order')->setLabel("Display Order")->setOrder(12)->setRequired(true));
		
		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Save Ad Banner')->setOrder(99));
	}
	
	public function makeEdit($id)
	{
		$this->addElement($this->createElement('plainText','adBannerIdDisplay')->setLabel("Ad Banner ID")->setValue($id)->setOrder(1));
		$this->addElement($this->createElement('hidden','adBannerID')->setRequired(true));
		$this->applyDecoratorPackage();		


	}
}
?>