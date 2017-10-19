<?php
class Default_Form_NewsletterSubscribe extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'firstName',
								'email'
	);
	
	protected $_buttonElements = array(
									'submit'
	);
	
	protected $_elementDecorators = array(
							array('ViewHelper',array('class' => 'txtbox-long')),
							'Description',
		                    array('Errors', array('class'=> 'form-error-inline'))
	);
	
	protected $_formDecorators = array(
							'FormElements',
							'Description',
							array('Form', array('class' =>'middle-forms'))
	);
	
	protected $_imageDecorators = array(
							'Image',
		                    array('Errors', array('class'=> 'form-error-inline'))
		                    
	);
		                   
	public function init()
	{	
		parent::init();	
		$this->setMethod('post');
		$this->setAttrib('id','newsletterSubscribe');
		$this->setDecorators($this->_formDecorators);
		
		$this->addPrefixPath('Sozfo_Form_Element', 'Sozfo/Form/Element/', 'element');
		$this->addPrefixPath('ZExt_Form_Element', 'ZExt/Form/Element/', 'element');
		
		$this->addElement($this->createElement('text','name')->removeDecorator('HtmlTag') ->removeDecorator('DtDdWrapper')->removeDecorator('Errors')->setAttrib('class','textFields')->setLabel("Name:")->setOrder(1)->setValue('Enter your first name...')->setRequired(false));
		$this->addElement($this->createElement('text','email')->removeDecorator('HtmlTag') ->removeDecorator('DtDdWrapper')->removeDecorator('Errors')->setAttrib('class','textFields')->setLabel("Email:")->setOrder(2)->setValue('Enter your email address...')->setRequired(false));
		
		Zend_Layout::getMvcInstance()->getView()->headScript()->captureStart(); ?>

		(function($) { 			 
			 $(document).ready(function() {
			 
		   $("#name").focus(function(){	if( $("#name").val()=='<?php echo $this->getElement('name')->getValue(); ?>') $("#name").val(''); });
		   $("#name").blur(function(){ if( $("#name").val()=='') $("#name").val('<?php echo $this->getElement('name')->getValue(); ?>');  });
		   $("#email").focus(function(){	if( $("#email").val()=='<?php echo $this->getElement('email')->getValue(); ?>') $("#email").val(''); });
		   $("#email").blur(function(){ if( $("#email").val()=='') $("#email").val('<?php echo $this->getElement('email')->getValue(); ?>');  });	   
			 
				$("#<?php echo $this->getAttrib('id');?>").submit(function(){					
					$.post( "<?php echo $_SERVER["REQUEST_URI"]; ?>", $(this).serialize(), function(data){
							if(data == true)
							{								
								$("#<?php echo $this->getAttrib('id');?>").empty().append('<div id="formSuccess">You have been subscribed. Thank you.</div>');
							}
							else
							{ 
								$(".form-error-inline").remove();
								for(var key in data)
								{
									var str = '<ul style="display:none" class="form-error-inline">';
									for( var innerKey in data[key] ){ str += '<li>'+ data[key][innerKey] + '</li>'; }
									$("#"+key).parent().append(str+"</ul>");
								}
								$(".form-error-inline").slideToggle("slow");
							};
							},"json");
					return false;
				});
				
			});	
			})(jQuery)
		<?php 	
		
		Zend_Layout::getMvcInstance()->getView()->headScript()->captureEnd();
		
		
		$this->addElement($this->createElement('image', 'submit' )->setLabel('Send')->setOrder(99)->setDecorators($this->_imageDecorators));
	}
	
	public function setImageSrc($src)
	{
		$this->getElement('submit')->setImage($src);
	}
}
?>