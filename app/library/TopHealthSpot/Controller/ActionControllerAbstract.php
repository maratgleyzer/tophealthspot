<?php
class TopHealthSpot_Controller_ActionControllerAbstract  extends Zend_Controller_Action
{
    public function preDispatch()
    {
		Zend_Feed_Reader::setCache(Zend_Registry::get('cache'));;    	
    	$config = Zend_Registry::get('configuration');
    	$feed = Zend_Feed_Reader::import($config->blog->rssFeed);
		$this->view->feed = $feed;    	
    	/*
    	 * variable "layoutCategories" is available to the view. It's purpose is to store
    	 * category/subCategory multi-dimensional array to be used to create left nav menu.
    	 * 
    	 */
		$coupon = new Default_Model_Coupon();
    	$category = new Default_Model_Category();
    	$special = new Default_Model_Special();
    	
    	$this->view->layoutSpecials = $special->fetchShowInLayoutArray(null);
	
    	
    	if($this->getRequest()->getModuleName() == 'default' && ($this->getRequest()->getControllerName() == 'category' || $this->getRequest()->getControllerName() == 'sub-category') )
    	{
    		
    	   	if( $this->getRequest()->getControllerName() == 'category' )
    		{
    			$id = $this->_getParam('id');
    			$_SESSION['categoryID'] = $id;
    		}
    		else
    		{
    			$subCategory = new Default_Model_SubCategory();
    			$subCategory->find($this->_getParam('id'));
    			$id = $subCategory->getCategoryID();
    		}

    		$this->view->layoutCategories = $category->fetchShowInLayoutArray($id);    	
    	}    		
    	else
    	{

    		$id = null;
 		
    		if ($this->getRequest()->getModuleName() == 'default') { 
    		
    			if (($this->getRequest()->getControllerName() == 'index') ||
    			 	($this->getRequest()->getControllerName() == 'content')) {
	    			$stores = $coupon->fetchStoresHavingCoupons();
	    			if (is_array($stores)) $this->view->layoutStores = $stores;
	    		    unset($_SESSION['categoryID']);
    			} else {
    				if ($this->_getParam('category') > 0) {
    					$id = $this->_getParam('category');
    				} elseif (isset($_SESSION['categoryID'])) {
    					$id = $_SESSION['categoryID'];
    				} else {
						$form = new Default_Form_StoreDropDown();
						$this->view->StoreDropDown = $form;
	    				$stores = $coupon->fetchStoresHavingCoupons();
	    				if (is_array($stores)) $this->view->layoutStores = $stores;
    				}
    			}
    		}
   			 	
    		//if ($this->_getParam('reset')) unset($_SESSION['categoryID']);
    		
    		//if($this->getRequest()->getModuleName() == 'default' && ($this->getRequest()->getControllerName() != 'content')) {

    			//if ($this->getRequest()->getControllerName() == 'index') unset($_SESSION['categoryID']);
    			
    			//$id = (isset($_SESSION['categoryID']) && ($_SESSION['categoryID'] > 0) ? $_SESSION['categoryID'] : null);
    			
    			//if (!isset($_SESSION['categoryID'])) {
				//	$form = new Default_Form_StoreDropDown();
				//	$this->view->StoreDropDown = $form;
    			//}
			
    			//$stores = $coupon->fetchStoresHavingCoupons();

    			//if (is_array($stores)) $this->view->layoutStores = $stores;
    		//} else { unset($_SESSION['categoryID']); }    			

        	$this->view->layoutCategories = $category->fetchShowInLayoutArray($id);

    	}
    }
}