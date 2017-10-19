<?php
class SubCategoryController extends TopHealthSpot_Controller_ActionControllerAbstract
{
    public function indexAction()
    {
    	
    }
    
    public function viewAction()
    {
    	$id = $this->_getParam('id');
    	$subCategory = new Default_Model_SubCategory();
    	$subCategory->find($id);
    	$this->view->subCategory = $subCategory;
    	$this->view->category = $subCategory;
    	$this->view->subCategoryID = $id;

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
    	
    	$coupon = new Default_Model_Coupon();
    	
		$paginator = Zend_Paginator::factory($coupon->fetchStoresWithCouponsInSubCategory($subCategory->getSubCategoryID()));
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(1000);		

		$this->view->coupon = $coupon;
		$this->view->storesPaginator = $paginator;
    	
    	$this->view->subCategoryHeader = $subCategory->getName();

		$this->view->headTitle($subCategory->getPageTitle());
		$this->view->headMeta()->appendName('keywords', $subCategory->getMetaKeywords());
		$this->view->headMeta()->appendName('description', $subCategory->getMetaDescription());
    	
    	$adBanner = new Default_Model_AdBanner();
    	$this->view->adBanners = $adBanner->fetchAllByCategory($subCategory->getCategoryID());

    	/*
    	 * $this->headerImage  contains the URL to the header image
    	 */
    	
    	/*
    	 * view variable - adBanners
    	 * Contains a numerically indexed array of adBanner ID's. To use,
    	 * 
    	 * 
    	 * <?php foreach( $this->view->adBanners as $adBanner) { ?>
    	 * <a href="/link/id/<?php echo $adBanner; ?>/"><img src="/assets/images/ad-banners/<?php echo $adBanner; ?>.png" /></a>
    	 * <?php } ?>    
    	 *  
    	 */
    	
    }
}

