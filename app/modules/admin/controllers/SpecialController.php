<?php
class Admin_SpecialController extends TopHealthSpot_Admin_Controller_Action 
{
    public function indexAction()
    {
    	$special = new Default_Model_Special();
		$paginator = Zend_Paginator::factory($special->fetchAllSelect());
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(25);		
		$this->view->paginator = $paginator;
    }
    
    public function deleteAction()
    {
    	$form = new Default_Form_Admin_DeleteConfirmation();
    	if( $this->getRequest()->isPost() )
    	{
    		$special = new Default_Model_Special();
    		$special->delete($this->_getParam('id'));
    		
    		$special_to_coupon = new Default_Model_SpecialToCoupon();
    		$special_to_coupon->deleteBySpecial($this->_getParam('id'));
    		
    		$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    	}
    	$this->view->form = $form;
    }
    
    public function addAction()
    {
    	$form = new Default_Form_Admin_Special();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData ) )
    		{
    			$special = new Default_Model_Special();
    			$special->setOptions($formData)->save();

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
    	$special = new Default_Model_Special();	
    	$special->find($this->_getParam('id'));
    	
    	
    	$form = new Default_Form_Admin_Special();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());    	
    	$form->makeEdit($this->_getParam('id'));
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData ) )
    		{
    			//$category = new Default_Model_Category();
    			$special->setOptions($formData)->save();
    			
    			$this->_helper->redirector('index', $this->getRequest()->getControllerName());
       		}
    		else
    		{
    			$form->populate($formData);
    		}
    	}
    	else
    	{
 		   	$form->populate($special->toArray());
    	}
    	$this->view->form = $form;
    }    
}
