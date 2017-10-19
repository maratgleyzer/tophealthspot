<?php 
abstract class TopHealthSpot_Admin_Controller_Action extends Zend_Controller_Action 
{
	public function preDispatch()
	{
		$auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('tophealth_Admin'));

		if( !$auth->hasIdentity() )
		{
			$this->_forward('index','login');	
		}
		else
		{
			$this->view->username = Zend_Auth::getInstance()->getIdentity();
			$identity = Zend_Auth::getInstance()->getIdentity();
			$this->view->displayName = $identity->firstName . ' ' . $identity->lastName;
		}
	}
}