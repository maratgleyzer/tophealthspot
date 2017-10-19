<?php
class Default_Form_Admin_Coupon extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'couponID',
								'storeID',
								'couponTitle',
								'description',
								'secondaryDescription',
								'couponCode',
								'image',
								'href',
								'details',
								'metaDescription',
								'metaKeywords',
								'featured',
								'couponIdDisplay'
	);
	
	protected $_checkboxElements = array(
								'subCategoryID',
								'specialID'
	);
	
	protected $_jQueryElements = array('expirationDate');
	
	protected $_buttonElements = array('submit');
	
	protected $_fileElements = array('couponImage');
	                   
	public function init()
	{	
		parent::init();	
		$this->setMethod('post');
		
		$this->addPrefixPath('Sozfo_Form_Element', 'Sozfo/Form/Element/', 'element');
		$this->addPrefixPath('ZExt_Form_Element', 'ZExt/Form/Element/', 'element');

		$store = new Default_Model_Store();
		$this->addElement($this->createElement('select','storeID')->setLabel("Store")->setRequired(true)
						->addMultiOption(array(''=>'Select a Store'))->addMultiOptions($store->fetchAllAsArray())
						->addFilter(new Zend_Filter_StringTrim())->setOrder(2));	
		
		$subCategory = new Default_Model_SubCategory();
			
		$this->addElement($this->createElement('multiCheckbox','subCategoryID',array('style'=>'width:20px;'))->setAttrib('helper','MultiCheckbox')->setLabel("Sub Categories")->setRequired(true)
							   ->addMultiOptions($subCategory->fetchArrayCatSubCategory())
							   ->addFilter(new Zend_Filter_StringTrim())->setOrder(3));		

		$specials = new Default_Model_Special();
			
		$this->addElement($this->createElement('multiCheckbox','specialID',array('style'=>'width:20px;'))->setAttrib('helper','MultiCheckbox')->setLabel("Specials")->setRequired(false)
							   ->addMultiOptions($specials->fetchAllAsArray())
							   ->addFilter(new Zend_Filter_StringTrim())->setOrder(4));		
							   
							   
		$this->addElement($this->createElement('text','couponTitle')->setLabel("Coupon Title")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(5));	

		$this->addElement($this->createElement('textarea','description')->setLabel("Description")->setOrder(6)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','secondaryDescription')->setLabel("Secondary Description")->setOrder(7)
						->setRequired(false)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	
		
		$this->addElement('tinyMce', 'details', array(
		    'label'      => 'Details',
			'required'   => false,
		    'cols'       => '25',
		    'rows'       => '10',
		    'editorOptions' => new Zend_Config_Ini(APPLICATION_PATH . '/../config/tinymce.ini', 'editor'),
			'order'		=> '11'
		));		
		
		$this->addElement($this->createElement('text','couponCode')->setLabel("Coupon Code")
						->setRequired(false)->addFilter(new Zend_Filter_StringTrim())->setOrder(8));

		$this->addElement($this->createElement('text','image')->setLabel("Image URL")
						->setRequired(false)->addFilter(new Zend_Filter_StringTrim())->setOrder(9));	

		$this->addElement($this->createElement('text','href')->setLabel("Destination")
						->setRequired(false)->addFilter(new Zend_Filter_StringTrim())->setOrder(10));	

		$this->addElement($this->createElement('textarea','metaKeywords')->setLabel("Meta Keywords")->setOrder(12)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','metaDescription')->setLabel("Meta Description")->setOrder(13)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));

		$this->addElement($this->createElement('file','couponImage')->setLabel("Coupon Image")->setOrder(14)->setRequired(false));
						
		$datePicker = new ZendX_JQuery_Form_Element_DatePicker('expirationDate');
		$datePicker->setName('expirationDate')
					->setLabel('Expiration Date')
					->setJQueryParams(array('dateFormat' => 'mm/dd/yy'))
					->setOrder(19)
				   ->setOptions(array(
				   					'defaultDate' =>  date('Y/m/d', time())));
				   
		$this->addElement($datePicker);

		$this->addElement($this->createElement('checkbox','featured')->setLabel("Featured")->setOrder(15));	
												
		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Save Coupon')->setOrder(99));
	}
	
	public function makeEdit($id)
	{
		$this->addElement($this->createElement('plainText','couponIdDisplay')
							->setLabel("Coupon ID")->setValue($id)->setOrder(1));
								
		$this->addElement($this->createElement('hidden','couponID')->setRequired(true));
		$this->applyDecoratorPackage();
	}
}
?>