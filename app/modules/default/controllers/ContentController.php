<?php
class ContentController extends TopHealthSpot_Controller_ActionControllerAbstract
{

    public function indexAction()
    {
    	
    }
	
	public function viewAction()
	{
		
		$contentID = $this->_getParam('id');
		
		$content = new Default_Model_Content();
		
    	$indexPage = new Default_Model_DbTable_IndexPage();
    	$row = $indexPage->find(1)->current();
		
		$this->view->newsletter_box_copy = $row['newsletter_box_copy'];
		$this->view->homepage_box_copy = $row['homepage_box_copy'];
		
		$this->view->h1_1 = $row['h1_1'];
		$this->view->h2_1 = $row['h2_1'];
		$this->view->h2_2 = $row['h2_2'];
		$this->view->h2_3 = $row['h2_3'];
		$this->view->h2_4 = $row['h2_4'];
		$this->view->h3_1 = $row['h3_1'];
		$this->view->h3_2 = $row['h3_2'];
		$this->view->h3_3 = $row['h3_3'];
		$this->view->h3_4 = $row['h3_4'];

		$content->find($contentID );
		
		$this->view->name = $content->getName();
		$this->view->content = $content->getDescription();
	
		$this->view->headTitle($content->getPageTitle());
		
		
		$this->view->headMeta()->appendName('keywords', $content->getMetaKeywords());
		$this->view->headMeta()->appendName('description', $content->getMetaDescription());
		
	}
	
	public function contactUsAction()
	{
		$form = new Default_Form_ContactUs();
		$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
		
		$this->view->contactUsForm = $form;
		
		if( $this->getRequest()->isPost() )
		{
			if( $form->isValid($this->getRequest()->getPost() ) )
			{
				$str = '';
				$data = $form->getValues();
				foreach( $data as $key => $val )
				{
					$str .= $key . '=' . $val . "	
";
				}
				
				$config = new Zend_Config_Ini(APPLICATION_PATH . '/../config/mailer.ini', APPLICATION_ENV);
				$transportConfig = array('ssl' => 'tls' , 'auth' => $config->notification->smtp->auth , 'username' => $config->notification->smtp->username , 'password' => $config->notification->smtp->password);
				$transport = new Zend_Mail_Transport_Smtp($config->notification->smtp->server, $transportConfig);
				$mailer = new Zend_Mail();
				$mailer->addTo($config->form->contact->email)->setSubject('Contact Us');
				$mailer->setFrom($config->notification->fromEmail, $config->notification->fromName);
				$mailer->setBodyText($str);
				
				$mailer->send($transport);
				
				$form->reset();
				$this->view->success = 'Thank you for your submission.';
				
			}
		}
	}
}