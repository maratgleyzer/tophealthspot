<?php
class Default_Form_EmailToFriend extends Default_Form_Abstract
{ 
	protected $_generalElements = array(
								'name',
								'email',
								'message'
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
		$this->setMethod('post');
		$this->setAttrib('id','emailToFriend');
		
		$this->addPrefixPath('Sozfo_Form_Element', 'Sozfo/Form/Element/', 'element');
		$this->addPrefixPath('ZExt_Form_Element', 'ZExt/Form/Element/', 'element');
		
		$this->addElement($this->createElement('text','name',array('style' => 'width:194px;'))->setLabel("Name")->setOrder(1)->setRequired(true));
		$this->addElement($this->createElement('text','email',array('style' => 'width:194px;'))->setLabel("Email")->setOrder(2)->setRequired(true)->addValidator(new Zend_Validate_EmailAddress()));
		$this->addElement($this->createElement('textarea','message',array('style' => 'width:194px;'))->setLabel("Message")->setOrder(3)->setRequired(false));		
		
		Zend_Layout::getMvcInstance()->getView()->headScript()->captureStart(); ?>
			 $(document).ready(function() {
			 
				$("#<?php echo $this->getAttrib('id');?>").submit(function(){					
					$.post( "<?php echo $_SERVER["REQUEST_URI"]; ?>", $(this).serialize(), function(data){
							if(data == true)
							{								
								$("#<?php echo $this->getAttrib('id');?>").empty().append('<div id="formSuccess">Email has been sent. Thank you.</div>');
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
		<?php 	
		Zend_Layout::getMvcInstance()->getView()->headScript()->captureEnd();
		
		$this->addElement($this->createElement('submit', 'submit', array('style' => 'width:200px;') )->setLabel('Send')->setOrder(99));
	}
}
?>