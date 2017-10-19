<?php
class Admin_CouponController extends TopHealthSpot_Admin_Controller_Action 
{
    public function indexAction()
    {	
    	$coupon = new Default_Model_Coupon();
		$paginator = Zend_Paginator::factory($coupon->fetchCouponsWithStoreName());
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(25);		
		$this->view->paginator = $paginator;
    }
    
    public function deleteAction()
    {
    	$form = new Default_Form_Admin_DeleteConfirmation();
    	if( $this->getRequest()->isPost() )
    	{
    		$coupon = new Default_Model_Coupon();
    		$coupon->delete($this->_getParam('id'));
    		
    		$special_to_coupon = new Default_Model_SpecialToCoupon();
    		$special_to_coupon->deleteByCoupon($this->_getParam('id'));
    		
    		$subCategory_to_coupon = new Default_Model_SubCategoryToCoupon();
    		$subCategory_to_coupon->deleteByCoupon($this->_getParam('id'));
    		
    		$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    	}
    	$this->view->form = $form;
    }
    
    public function addAction()
    {
    	$form = new Default_Form_Admin_Coupon();
    	
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();

    		if( $form->isValid($formData ) )
    		{
    			$coupon = new Default_Model_Coupon();
    			$coupon->setOptions($formData)->save();
    		    			    			
    			$subCategory_to_coupon = new Default_Model_SubCategoryToCoupon();
    			
    			foreach ($formData['subCategoryID'] as $key => $value) {
    				$subCategory_to_coupon->subCategoryID = $value;
    				$subCategory_to_coupon->couponID = $coupon->getCouponID();
       				$subCategory_to_coupon->save($subCategory_to_coupon);
    			}
    			
    			$special_to_coupon = new Default_Model_SpecialToCoupon();
    			
    			if (is_array($formData['specialID'])) {
    				foreach ($formData['specialID'] as $key => $value) {
    					$special_to_coupon->specialID = $value;
    					$special_to_coupon->couponID = $coupon->getCouponID();
    					$special_to_coupon->save($special_to_coupon);
    				}
    			}
    			
    			if ($_FILES['couponImage']['tmp_name'])
    		    if(is_uploaded_file($_FILES['couponImage']['tmp_name']))
    			{
	    			$couponImage = DOCROOT_PATH . '/assets/images/coupons/' . $coupon->getCouponID() . '.jpg';	    			
					if (!move_uploaded_file($_FILES['couponImage']['tmp_name'], $couponImage))
						$upload_error = true;
    			}
    			else { $upload_error = true; }

    			if (!$upload_error) {
    				$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    				exit;
    			}
       		}
      		
       		if ($upload_error)
       			$this->view->upload_error .= "An error occurred and the COUPON IMAGE file could not be uploaded.";
       		
    		$form->populate($formData);
    	}
    	
    	$this->view->form = $form;
    }
        
    public function editAction()
    {
    	$coupon = new Default_Model_Coupon();	
    	$coupon->find($this->_getParam('id'));

    	$form = new Default_Form_Admin_Coupon();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());    	
    	$form->makeEdit($coupon->getCouponID());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();

    		if( $form->isValid($formData ) )
    		{
    			$coupon = new Default_Model_Coupon();
    			$coupon->setOptions($formData)->save();
    			    			
    			$subCategory_to_coupon = new Default_Model_SubCategoryToCoupon();
    			
    			if (is_array($formData['subCategoryID'])) {
    				$subCategory_to_coupon->deleteByCoupon($this->_getParam('id'));
    				foreach ($formData['subCategoryID'] as $key => $value) {
    					$subCategory_to_coupon->subCategoryID = $value;
    					$subCategory_to_coupon->couponID = $this->_getParam('id');
       					$subCategory_to_coupon->save($subCategory_to_coupon);
    				}
    			}
    			
    			$special_to_coupon = new Default_Model_SpecialToCoupon();
    			$special_to_coupon->deleteByCoupon($this->_getParam('id'));
    			
    			if (is_array($formData['specialID'])) {
    				foreach ($formData['specialID'] as $key => $value) {
    					$special_to_coupon->specialID = $value;
    					$special_to_coupon->couponID = $this->_getParam('id');
    					$special_to_coupon->save($special_to_coupon);
    				}
    			}
    			
    			if ($_FILES['couponImage']['tmp_name'])
    		    if(is_uploaded_file($_FILES['couponImage']['tmp_name']))
    			{
	    			$couponImage = DOCROOT_PATH . '/assets/images/coupons/' . $coupon->getCouponID() . '.jpg';	    			
					if (!move_uploaded_file($_FILES['couponImage']['tmp_name'], $couponImage))
						$upload_error = true;
    			}
    			else { $upload_error = true; }

    			if (!$upload_error) {
    				$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    				exit;
    			}
       		}
       		
       		if ($upload_error)
       			$this->view->upload_error .= "An error occurred and the COUPON IMAGE file could not be uploaded.";
       		
   			$form->populate($formData);
    	}
    	else
    	{
    		$form->populate($coupon->toArray());
    	}
    	
    	$this->view->form = $form;
    
    }    

}
