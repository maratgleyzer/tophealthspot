<?php
class Default_Form_Admin_IndexPage extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'pageTitle',	
								'metaDescription',
								'metaKeywords',
								'newsletter_box_copy',
								'homepage_box_copy',
								'h1_1',
								'h2_1',
								'h2_2',
								'h2_3',
								'h2_4',
								'h3_1',
								'h3_2',
								'h3_3',
								'h3_4'
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

		$this->addElement($this->createElement('text','pageTitle')->setLabel("Page Title")
						->setRequired(false)->addFilter(new Zend_Filter_StringTrim())->setOrder(3));	
		
		$this->addElement($this->createElement('textarea','metaKeywords')->setLabel("Meta Keywords")->setOrder(11)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','metaDescription')->setLabel("Meta Description")->setOrder(12)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement($this->createElement('textarea','newsletter_box_copy')->setLabel("Newsletter Box Copy")->setOrder(13)
						->setRequired(true)->setAttrib('rows','5')->addFilter(new Zend_Filter_StringTrim()));	

		$this->addElement('tinyMce', 'homepage_box_copy', array(
		    'label'      => 'Homepage Box Copy',
			'required'   => true,
		    'cols'       => '15',
		    'rows'       => '10',
		    'editorOptions' => new Zend_Config_Ini(APPLICATION_PATH . '/../config/tinymce.ini', 'editor'),
			'order'		=> '14'
		));

		$this->addElement($this->createElement('text','h1_1')->setLabel("H1 Text")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(15));	
						
		$this->addElement($this->createElement('text','h2_1')->setLabel("H2 Text (1)")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(16));	

		$this->addElement($this->createElement('text','h2_2')->setLabel("H2 Text (2)")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(17));	

		$this->addElement($this->createElement('text','h2_3')->setLabel("H2 Text (3)")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(18));	

		$this->addElement($this->createElement('text','h2_4')->setLabel("H2 Text (4)")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(19));

		$this->addElement($this->createElement('text','h3_1')->setLabel("H3 Text (1)")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(20));
						
		$this->addElement($this->createElement('text','h3_2')->setLabel("H3 Text (2)")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(21));	
						
		$this->addElement($this->createElement('text','h3_3')->setLabel("H3 Text (3)")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(22));

		$this->addElement($this->createElement('text','h3_4')->setLabel("H3 Text (4)")
						->setRequired(true)->addFilter(new Zend_Filter_StringTrim())->setOrder(23));						

		$this->addElement($this->createElement('submit', 'submit' )->setLabel('Save Index')->setOrder(99));
	}
	
}
?>