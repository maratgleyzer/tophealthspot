<?php
class Admin_StoreController extends TopHealthSpot_Admin_Controller_Action 
{
    public function indexAction()
    {
    	$store = new Default_Model_Store();
		$paginator = Zend_Paginator::factory($store->fetchAllSelect());
		$paginator->setCurrentPageNumber($this->_getParam('page'));		
		$paginator->setItemCountPerPage(25);
		$this->view->paginator = $paginator;
    }
    
    public function deleteAction()
    {
    	$form = new Default_Form_Admin_DeleteConfirmation();
    	if($this->getRequest()->isPost() )
    	{
    		$id = $this->_getParam('id');
    		
    		$store = new Default_Model_Store();
	    	$store->delete($id);
			
    		$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    	}
    	
    	$this->view->form = $form;
    }
    
    public function addAction()
    {
    	$form = new Default_Form_Admin_Store();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());

    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData))
    		{
    			$store = new Default_Model_Store();
    			$store->setOptions($formData);
    			$store->save();
    			
    		    if(is_uploaded_file($_FILES['storelogo']['tmp_name']))
    			{
	    			$storelogo = DOCROOT_PATH . '/assets/images/store-logos/' . $store->getStoreID() . '.jpg';	    			
					if (!move_uploaded_file($_FILES['storelogo']['tmp_name'], $storelogo))
						$upload_error['logo'] = true;
    			}
    			else { $upload_error['logo'] = true; }
    		
    			if(is_uploaded_file($_FILES['storescreenshot']['tmp_name']))
    			{
	    			$storescreenshot = DOCROOT_PATH . '/assets/images/store-screenshots/' . $store->getStoreID() . '.gif';	    			
					if (!move_uploaded_file($_FILES['storescreenshot']['tmp_name'], $storescreenshot))
						$upload_error['screenshot'] = true;
       			}
    			else { $upload_error['screenshot'] = true; }

    			if (!$upload_error) {
    				$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    				exit;
    			}
       		}

       		$this->view->upload_error = "";
       		
       		if (isset($upload_error['logo']))
       			$this->view->upload_error .= "An error occurred and the STORE LOGO file could not be uploaded. Please make sure the file is the correct format (*.JPG) and size (192 pixels wide, 48 pixels high).";
       		
       		if (isset($upload_error['screenshot']))
       			$this->view->upload_error .= "An error occurred and the STORE SCREENSHOT file could not be uploaded. Please make sure the file is the correct format (*.GIF) and size (288 pixels wide, 162 pixels high).";
       		
    		$form->populate($formData);
    	}
    	
    	$this->view->form = $form;
    }
    
    public function editAction()
    {
    	$store = new Default_Model_Store();
    	$store->find($this->_getParam('id'));
    	
    	$form = new Default_Form_Admin_Store();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
    	$form->makeEdit($store->getStoreID());

    	if( $this->getRequest()->isPost())
    	{

    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData))
    		{
    			$store = new Default_Model_Store();
    			$store->setOptions($formData);
    			$store->save();

    			if ($_FILES['storelogo']['tmp_name'])
    		    if(is_uploaded_file($_FILES['storelogo']['tmp_name']))
    			{
	    			$storelogo = DOCROOT_PATH . '/assets/images/store-logos/' . $store->getStoreID() . '.jpg';	    			
					if (!move_uploaded_file($_FILES['storelogo']['tmp_name'], $storelogo))
						$upload_error['logo'] = true;
    			}
    			else { $upload_error['logo'] = true; }
    		
    			if ($_FILES['storescreenshot']['tmp_name'])
    			if(is_uploaded_file($_FILES['storescreenshot']['tmp_name']))
    			{
	    			$storescreenshot = DOCROOT_PATH . '/assets/images/store-screenshots/' . $store->getStoreID() . '.gif';	    			
					if (!move_uploaded_file($_FILES['storescreenshot']['tmp_name'], $storescreenshot))
						$upload_error['screenshot'] = true;
       			}
    			else { $upload_error['screenshot'] = true; }

    			if (!$upload_error) {
    				$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    				exit;
    			}
       		}

       		$this->view->upload_error = "";
       		
       		if (isset($upload_error['logo']))
       			$this->view->upload_error .= "An error occurred and the STORE LOGO file could not be uploaded. Please make sure the file is the correct format (*.JPG) and size (192 pixels wide, 48 pixels high).";
       		
       		if (isset($upload_error['screenshot']))
       			$this->view->upload_error .= "An error occurred and the STORE SCREENSHOT file could not be uploaded. Please make sure the file is the correct format (*.GIF) and size (288 pixels wide, 162 pixels high).";
       		
   			$form->populate($formData);
    	}
    	else
    	{
    		$form->populate($store->toArray());
    	}
    	
    	$this->view->form = $form;
    
    }    
}
