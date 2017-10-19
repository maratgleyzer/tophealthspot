<?php
class IndexController extends TopHealthSpot_Controller_ActionControllerAbstract
{
    public function searchAction()
    {
    		$coupons = new Default_Model_Coupon();
			$paginator = Zend_Paginator::factory($coupons->search($this->_getParam('searchBox')));
			$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(1000);		
			$this->view->searchPaginator = $paginator;
			
	    	$adBanner = new Default_Model_AdBanner();
	    	$this->view->adBanners = $adBanner->fetchAllGlobal();
    	
    		
    }
	
    public function indexAction()
    {
    	$indexPage = new Default_Model_DbTable_IndexPage();
    	$row = $indexPage->find(1)->current();
    	
		$this->view->headTitle($row['pageTitle']);
		$this->view->headMeta()->appendName('keywords', $row['metaKeywords']);
		$this->view->headMeta()->appendName('description', $row['metaDescription']);
		
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
    	
    	$form = new Default_Form_NewsletterSubscribe();
    	$this->view->newsletterForm = $form;

    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData ) )
    		{
				$config = new Zend_Config_Ini(APPLICATION_PATH . '/../config/mailer.ini', APPLICATION_ENV);
				
				$mailChimp = new TopHealthSpot_Mail_MailChimpApi($config->mailchimp->key);				
				if( $mailChimp->listSubscribe($config->mailchimp->listID, $formData['email'], array('FNAME'=>$formData['name'])) )
				{
					$form->reset()->setDescription('Email has been sent. Thank you');
				}
    		}
			if ($this->getRequest()->isXmlHttpRequest())
			{
				$this->getResponse()->setBody($form->processAjax($formData))->sendResponse();
				die();
			}
    	}
    	
    	$form = new Default_Form_StoreDropDown();
    	$this->view->StoreDropDown = $form;
    	
    	$adBanner = new Default_Model_AdBanner();
     	$coupon = new Default_Model_Coupon();

		$paginator = Zend_Paginator::factory($coupon->fetchStoresWithCouponsAll());
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(1000);		

		$featuredCoupon = new Default_Model_Coupon();
		$this->view->featuredCoupons = $featuredCoupon->fetchFeatured();
		$this->view->storesPaginator = $paginator;
		$this->view->coupon = $coupon;
    	$this->view->adBanners = $adBanner->fetchAllGlobal();
    	$this->view->indexHeader = $this->view->render('index/index-header.phtml');

    }
}

