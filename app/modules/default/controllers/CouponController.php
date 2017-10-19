<?php
class CouponController extends TopHealthSpot_Controller_ActionControllerAbstract
{
	public function indexAction ()
	{}
	
	/*
	 * #View Notes#
	 * Variables available:
	 * - coupon : associative array : {couponID, couponTitle, description, secondaryDescription, couponCode, expirationDate}
	 * - store : associative array : [storeID, description, url]
	 * - adBanners : indexed array of array { dimensions, url }
	 * - sendToFriend : HTML Form
	 * - 
	 */
	public function viewAction ()
	{

		if ($this->_getParam('use'))
		{
			
			$id = $this->_getParam('id');
			$coupon = new Default_Model_Coupon();
			$coupon->find($id);
			
			$coupon->setClickcount($coupon->getClickcount() + 1);
			
			$coupon->updateClickcount( $coupon );
			
			$this->_redirect($coupon->getHref());
			exit;
			
		}

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
		
		$form = new Default_Form_EmailToFriend();
		$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
		if ($this->getRequest()->isPost())
		{
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData))
			{
				$this->sendEmailToFriend($formData['name'], $formData['email'], $formData['message']);
				$form->reset()->setDescription('Email has been sent. Thank you');
			}
			if ($this->getRequest()->isXmlHttpRequest())
			{
				$this->getResponse()->setBody($form->processAjax($formData))->sendResponse();
				die();
			}
		}
		$id = $this->_getParam('id');
		$coupon = new Default_Model_Coupon();
		$coupon->find($id);
		$store = new Default_Model_Store();
		$store->find($coupon->getStoreID());
		$this->view->coupon = $coupon->toArray();
		$this->view->sendToFriendForm = $form;
		$this->view->store = $store->toArray();
		$this->view->store['url'] = $store->getUrl();
		$adBanner = new Default_Model_AdBanner();
		$subCategory = new Default_Model_SubCategory();
		$subCategory->find($coupon->getSubCategoryID());
		$this->view->headerImage = '/assets/images/category-headers/' . $subCategory->getCategoryID() . '.png';
		$this->view->adBanners = $adBanner->fetchAllByCategory($subCategory->getCategoryID());
		
		$this->view->headTitle($coupon->getCouponTitle());
		$this->view->headMeta()->appendName('keywords', $coupon->getMetaKeywords());
		$this->view->headMeta()->appendName('description', $coupon->getMetaDescription());	
		
	}
	public function sendEmailToFriend ($name, $email, $message)
	{
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/../config/mailer.ini', APPLICATION_ENV);
		$this->view->couponID = $this->_getParam('id');
		$this->view->email = $email;
		$this->view->name = $name;
		$this->view->message = $message;
		$transportConfig = array('ssl' => 'tls' , 'auth' => $config->notification->smtp->auth , 'username' => $config->notification->smtp->username , 'password' => $config->notification->smtp->password);
		$transport = new Zend_Mail_Transport_Smtp($config->notification->smtp->server, $transportConfig);
		$mailer = new Zend_Mail();
		$mailer->addTo($email, $name)->setSubject($config->notification->subject);
		$mailer->setFrom($config->notification->fromEmail, $config->notification->fromName);
		$mailer->setBodyText($this->view->render('email-body-text.phtml'));
		$mailer->setBodyHtml($this->view->render('email-body-html.phtml'));
		$mailer->send($transport);
	}
}

