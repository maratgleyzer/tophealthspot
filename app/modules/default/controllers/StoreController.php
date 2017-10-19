<?php
class StoreController extends TopHealthSpot_Controller_ActionControllerAbstract
{
	public function indexAction()
	{
		$store = new Default_Model_Store();
		$stores = $store->fetchAllAsResult();
		$this->view->stores = $stores;

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

		$this->view->headTitle('All Stores Featured On TopHealthSpot.com');
		$this->view->headMeta()->appendName('keywords', 'health coupons, coupon codes');
		$this->view->headMeta()->appendName('description', 'A list of all health product and service providers which offer health related coupons, discounts, and free samples.');
		
		$adBanner = new Default_Model_AdBanner();
    	$this->view->adBanners = $adBanner->fetchAllGlobal();
	}
	
	public function viewAction()
	{
		$id = $this->_getParam('id');
		$store = new Default_Model_Store();
		$store->find($id);
		$this->view->store = $store;
		$coupon = new Default_Model_Coupon();
		$coupons = $coupon->fetchByStore($id);
		$this->view->coupons = $coupons;
		$this->view->store = $store;

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

		$this->view->headTitle($store->getPageTitle());
		$this->view->headMeta()->appendName('keywords', $store->getMetaKeywords());
		$this->view->headMeta()->appendName('description', $store->getMetaDescription());
		
		$recommended = $coupon->fetchRecommended($id);
		$this->view->recommended = $recommended;	
		
		$adBanner = new Default_Model_AdBanner();
    	$this->view->adBanners = $adBanner->fetchAllGlobal();
	}
}

