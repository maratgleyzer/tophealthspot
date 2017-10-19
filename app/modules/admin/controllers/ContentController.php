<?php
class Admin_ContentController extends TopHealthSpot_Admin_Controller_Action 
{
    public function indexAction()
    {	
    	$coupon = new Default_Model_Content();
		$paginator = Zend_Paginator::factory($coupon->fetchAllSelect());
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(25);		
		$this->view->paginator = $paginator;
    }
    
    public function deleteAction()
    {
    	$form = new Default_Form_Admin_DeleteConfirmation();
    	if( $this->getRequest()->isPost() )
    	{
    		    	$content = new Default_Model_Content();
    		    	$content->delete($this->_getParam('id'));
    				$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    	}
    	$this->view->form = $form;
    }
    
    
    public function addAction()
    {
    	$form = new Default_Form_Admin_Content();
    	
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();

    		if( $form->isValid($formData ) )
    		{
    			$content = new Default_Model_Content();
    			$content->setOptions($formData)->save();
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
    	$content = new Default_Model_Content();	
    	$content->find($this->_getParam('id'));
    	
    	$form = new Default_Form_Admin_Content();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());    	
    	$form->makeEdit($content->getContentID());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();

    		if( $form->isValid($formData ) )
    		{
    			$content = new Default_Model_Content();
    			$content->setOptions($formData)->save();
    			$this->_helper->redirector('index', $this->getRequest()->getControllerName());
       		}
    	}
    	else
    	{	    	
 		   	$form->populate($content->toArray());
    	}
    	$this->view->form = $form;
    }

    public function indexPageAction()
    {
    	$form = new Default_Form_Admin_IndexPage();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());  
    	if( $this->getRequest()->isPost() )
    	{
    		if( $form->isValid($this->getRequest()->getPost() ) )
    		{
    			$indexPage = new Default_Model_DbTable_IndexPage();
    			$arr = array('metaDescription'			=> $form->getValue('metaDescription'),
    						 'metaKeywords'			 	=> $form->getValue('metaKeywords'),
    						 'pageTitle'				=> $form->getValue('pageTitle'),
    						 'newsletter_box_copy'		=> $form->getValue('newsletter_box_copy'),
    						 'homepage_box_copy'		=> $form->getValue('homepage_box_copy'),
    						 'h1_1'						=> $form->getValue('h1_1'),
    						 'h2_1'						=> $form->getValue('h2_1'),
    						 'h2_2'						=> $form->getValue('h2_2'),
    						 'h2_3'						=> $form->getValue('h2_3'),
    						 'h2_4'						=> $form->getValue('h2_4'),
    						 'h3_1'						=> $form->getValue('h3_1'),
    						 'h3_2'						=> $form->getValue('h3_2'),
    						 'h3_3'						=> $form->getValue('h3_3'),
    						 'h3_4'						=> $form->getValue('h3_4'),
    			);
    			
    			$indexPage->update($arr, 'indexPageID = 1');  			
    		}
    	}
    	else
    	{
    			$indexPage = new Default_Model_DbTable_IndexPage();
    			$row = $indexPage->find(1)->current();
    			
    			$form->populate($row->toArray());
       	}
    	
    	$this->view->form = $form;
    }
    
}
