<?php 
class Admin_LoginController extends Zend_Controller_Action 
{
    public function indexAction() 
    {
    	if( !isset( $this->view->loginForm) )
    	{
    		$this->view->loginForm = $this->_getLoginForm();
    	}
		$this->_helper->layout->disableLayout();
    		    	
    }
    
    public function authAction()
    {
    	
    	$form = $this->_getLoginForm();
		if( $this->getRequest()->isPost() )
		{				
    		$formData = $this->getRequest()->getPost();
    		
			if( $form->isValid($formData ) )
			{			
				$auth = Zend_Auth::getInstance();
				$auth->setStorage(new Zend_Auth_Storage_Session('tophealth_Admin'));
				
				$authAdapter = new Zend_Auth_Adapter_DbTable(
					Zend_Registry::get('dbAdapter'),
					'adminUsers',
					'username',
					'password',
					'MD5(?)' 
				);
				
				$authAdapter->setIdentity($_POST['username']);
				$authAdapter->setCredential($_POST['password']);
				$result = $auth->authenticate($authAdapter);
				if( $result->isValid() )
				{
					$storage = $auth->getStorage();
					$storage->write($authAdapter->getResultRowObject(array('username','firstName','lastName')));					
					$this->_helper->redirector('index', 'index');
				}
				else
				{
						$form->populate($_POST );
						$form->setDescription('Username/PW combination is incorrect');
						$this->view->loginForm = $form;
						$this->_helper->layout->disableLayout();
						$this->render('index');
				}
			}
			else
			{
				
				$form->populate($_POST );
				$form->setDecorators(array(
							'FormElements',
							'Form'
							));
				
				$this->view->loginForm = $form;				
				$this->_forward('index');
			}
		}
		else
		{
			$this->_redirect('/login/');
		}    	
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index'); // back to login page
    }
    
    
	protected function _getLoginForm()
	{		
		$form = new Default_Form_Admin_Login();
		$form->setAction($this->_helper->url('auth'));
		return $form;
	}
    
}

