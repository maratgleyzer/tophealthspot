<?php
class TopHealthSpot_Form_Decorator_Package_Backend extends TopHealthSpot_Form_Decorator_Abstract
{
	protected $_general = array(
							array('ViewHelper',array('class' => 'txtbox-long')),
							'Description',
		                    array('Errors', array('class'=> 'form-error-inline')),
							array('Label', array('class'=>'field-title', 'placement'=>'prepend' )),
							array(array('row'=>'HtmlTag'),array('tag'=>'li') )
	);

	protected $_checkbox = array(
							array('ViewHelper',array('class' => 'txtbox-long')),
							'Description',
		                    array('Errors', array('class'=> 'form-error-inline')),
							array('Label', array('class'=>'field-title-long', 'placement'=>'prepend' )),
							array(array('row'=>'HtmlTag'),array('tag'=>'li') )
	);
	
	protected $_button = array(
							array('ViewHelper',array('class' => 'txtbox-long')),
							'Description',
							'Errors',
							array(array('buttonLabel'=>'HtmlTag'),array('tag' => 'label', 'class'=>'field-title', 'placement'=>'prepend' ) ),
							array(array('row'=>'HtmlTag'),array('tag'=>'li') )
	);

	protected $_file = array(
							'File',
							'Description',
		                    array('Errors', array('class'=> 'form-error-inline')),
							array('Label', array('class'=>'field-title', 'placement'=>'prepend' )),
							array(array('row'=>'HtmlTag'),array('tag'=>'li') )
		);
	
	
	protected $_jQuery = array(
	                   array('UiWidgetElement', array('tag' => '')),
                   	   'Description',
		                    array('Errors', array('class'=> 'form-error-inline')),
							array('Label', array('class'=>'field-title', 'placement'=>'prepend' )),
							array(array('row'=>'HtmlTag'),array('tag'=>'li') )
	                   );
	
	protected $_form = array(
							'FormElements',
							'Description',
							array(array('data'=>'HtmlTag'),array('tag'=>'ol')),
							array('Form', array('class' =>'middle-forms'))
	);
	
}