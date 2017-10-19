<?php
class Admin_AdBannerController extends TopHealthSpot_Admin_Controller_Action 
{
    public function indexAction()
    {
    	$adBanner = new Default_Model_AdBanner();
		$paginator = Zend_Paginator::factory($adBanner->fetchSelectAllWithCategory());
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(25);		
		$this->view->paginator = $paginator;
    }
    
    public function deleteAction()
    {
    	$form = new Default_Form_Admin_DeleteConfirmation();
    	if( $this->getRequest()->isPost() )
    	{
    		    	$adBanner = new Default_Model_AdBanner();
    		    	$adBanner->delete($this->_getParam('id'));
    				$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    	}
    	$this->view->form = $form;
    }
    
    
    public function addAction()
    {
    	$form = new Default_Form_Admin_AdBanner();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData ) )
    		{
    			$adBanner = new Default_Model_AdBanner(); 
    			$adBanner->setOptions($formData)->save();
    			
    			if($_FILES['bannerFile']['tmp_name'] != '' )
    			{
	    			$fileFormat = '.png';
	    			
	    			$new = APPLICATION_PATH . '/../htdocs/assets/images/ad-banners/' . $adBanner->getAdBannerID() . $fileFormat;
	 	    		TopHealthSpot_Admin_ImageResizer::resize($_FILES['bannerFile']['tmp_name'], 250, 1250, $new);				
    			}
    			
    			$this->_helper->redirector('index', $this->getRequest()->getControllerName());
       		}
    		else
    		{
    			$form->populate($formData);
    		}
    	}
    	$this->view->form = $form;
    }
    
    public function editAction()
    {
    	$adBanner = new Default_Model_AdBanner();	
    	$adBanner->find($this->_getParam('id'));
    	
    	$form = new Default_Form_Admin_AdBanner();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());    	
    	$form->makeEdit($adBanner->getAdBannerID());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData ) )
    		{
    			$adBanner = new Default_Model_AdBanner();
    			$adBanner->setOptions($formData)->save();

    			if($_FILES['bannerFile']['tmp_name'] != '' )
    			{
	    			$fileFormat = '.png';
	    			
	    			$new = APPLICATION_PATH . '/../htdocs/assets/images/ad-banners/' . $adBanner->getAdBannerID() . $fileFormat;
	    			TopHealthSpot_Admin_ImageResizer::resize($_FILES['bannerFile']['tmp_name'], 250, 1250, $new);				
    			}
    			
    			$this->_helper->redirector('index', $this->getRequest()->getControllerName());
       		}
    		else
    		{
    			$form->populate($formData);
    		}
    	}
    	else
    	{
 		   	$form->populate($adBanner->toArray());
    	}
    	$this->view->form = $form;
    }    
}
