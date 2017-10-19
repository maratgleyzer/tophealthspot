<?php
class Default_Form_StoreDropDown extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'stores',
	);
	
	protected $_buttonElements = array(
									'submit'
	);
	                   
	public function init()
	{	
		parent::init();	
		$this->setMethod('post');
		$this->setAttrib('id','StoreDropDown');
		
		$store = new Default_Model_Store();
		$stores = $store->fetchAllAsArray();

		$options[] = "-- select a store --";
		
		foreach ($stores as $storeID => $storeName)
		{
			
			$options[$storeID] = $storeName;
			
		}
		
		$this->addPrefixPath('Sozfo_Form_Element', 'Sozfo/Form/Element/', 'element');
		$this->addPrefixPath('ZExt_Form_Element', 'ZExt/Form/Element/', 'element');
		
		$this->addElement($this->createElement('select','stores',array('onchange' => 'window.location = "/store/"+this.value+"/"+this.options[this.selectedIndex].text;', 'style' => 'width:164px;margin-left:14px;'))
	 		 ->setOrder(1)
			 ->setRequired(false)
			 ->addMultiOptions($options)
			 ->removeDecorator('label')
             ->removeDecorator('HtmlTag'));
	}

}
?>