<?php
class Admin_CategoryController extends TopHealthSpot_Admin_Controller_Action 
{
    public function indexAction()
    {
    	$store = new Default_Model_Category();
		$paginator = Zend_Paginator::factory($store->fetchAllSelect());
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(25);		
		$this->view->paginator = $paginator;
    }
    
    public function deleteAction()
    {
    	$form = new Default_Form_Admin_DeleteConfirmation();
    	if( $this->getRequest()->isPost() )
    	{
    		    	$category = new Default_Model_Category();
    		    	$category->delete($this->_getParam('id'));
    				$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    	}
    	$this->view->form = $form;
    }
    
    public function addAction()
    {
    	$form = new Default_Form_Admin_Category();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData ) )
    		{
    			$category = new Default_Model_Category();
    			$category->setOptions($formData)->save();
    			
    			if($_FILES['headerBannerFile']['tmp_name'] != '' )
    			{
	    			$fileFormat = '.png';
	    			
	    			$new = APPLICATION_PATH . '/../htdocs/assets/images/category-headers/' . $category->getCategoryID() . $fileFormat;
	    			TopHealthSpot_Admin_ImageResizer::resize($_FILES['headerBannerFile']['tmp_name'], 697, 1250, $new);				
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
    	$category = new Default_Model_Category();	
    	$category->find($this->_getParam('id'));
    	
    	
    	$form = new Default_Form_Admin_Category();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());    	
    	$form->makeEdit($this->_getParam('id'));
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData ) )
    		{
    			//$category = new Default_Model_Category();
    			$category->setOptions($formData)->save();

    			if($_FILES['headerBannerFile']['tmp_name'] != '' )
    			{
	    			$fileFormat = '.png';
	    			
	    			$new = APPLICATION_PATH . '/../htdocs/assets/images/category-headers/' . $category->getCategoryID() . $fileFormat;
	    			TopHealthSpot_Admin_ImageResizer::resize($_FILES['headerBannerFile']['tmp_name'], 697, 1250, $new);				
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
 		   	$form->populate($category->toArray());
    	}
    	$this->view->form = $form;
    }    
}
