<?php

class Default_Form_Admin_Login extends Zend_Form
{	
	public function init()
	{
		$this->setMethod('post');
		
		$redirectPass = $this->createElement('hidden', 'redirectPass')->clearDecorators();
		$redirectFail = $this->createElement('hidden', 'redirectFail')->clearDecorators();
		
		$this->addElements(array($redirectPass, $redirectFail));
		
		$username = $this->createElement('text','username');
		$username->addValidator('EmailAddress');
		$username->setRequired(true);
		$username->setLabel("Email:")->setAttrib('class', 'field text full');
				
		$username->setDecorators(array(
				                   'ViewHelper',
				                   'Description',
				                   array('Errors', array('class'=> 'backend-form-login-error')),
				                   /*array(array('data'=>'HtmlTag'), array('tag' => 'li')),*/
				                   array('Label', array('tag' => 'label', 'class'=>'backend-form-login desc', 'placement'=>'prepend' )),
				                   array(array('row'=>'HtmlTag'),array('tag'=>'li') )
				                   ));
				
		$this->addElement($username);		
		
		$pw = $this->createElement('password','password');
		$pw->addValidator('StringLength', array(false,array(6)));
		$pw->setRequired(true)->setLabel("Password");;
		$pw->setAttrib('class', 'field text full');
		$pw->setDecorators(array(
				                   'ViewHelper',
				                   'Description',
				                   array('Errors', array('class'=> 'backend-form-login-error')),
				                   /*array(array('data'=>'HtmlTag'), array('tag' => 'li')),*/
				                   array('Label', array('tag' => 'label', 'class'=>'backend-form-login desc', 'placement'=>'prepend' )),
				                   array(array('row'=>'HtmlTag'),array('tag'=>'li') )
				                   ));
				
		$this->addElement($pw);		

		$submit = $this->createElement('submit','submit');
		$submit->setLabel("Log in to your account");
		$submit->setAttrib('class', 'ui-state-default ui-corner-all backend-login-submit');
		
		$submit->setDecorators(array(	
			'ViewHelper',
			'Description',
			'Errors',
			array(array('row'=>'HtmlTag'),array('tag'=>'li') )
			
			)
		);
		
		$this->addElement($submit);		
		$this->setAttrib('id', 'FORM_LOGIN');
		
		$this->setDecorators(array(
							'FormElements',
							array('Description', array('placement' => 'append','class'=>'response-msg error ui-corner-all')),
							'FormErrors',
							'Form'
							));
	}
}
?>