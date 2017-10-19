<?php
class Admin_SubCategoryController extends TopHealthSpot_Admin_Controller_Action 
{
    public function indexAction()
    {
    	$store = new Default_Model_SubCategory();
		$paginator = Zend_Paginator::factory($store->fetchAllWithParentSelect());
		$paginator->setCurrentPageNumber($this->_getParam('page'));		
		$paginator->setItemCountPerPage(25);
		$this->view->paginator = $paginator;
    }
    
    public function deleteAction()
    {
    	$form = new Default_Form_Admin_DeleteConfirmation();
    	if( $this->getRequest()->isPost() )
    	{
    		$subCategory = new Default_Model_SubCategory();
    		$subCategory->delete($this->_getParam('id'));
    		
    		$subCategory_to_coupon = new Default_Model_SubCategoryToCoupon();
    		$subCategory_to_coupon->deleteBySubCategory($this->_getParam('id'));
    		
    		$this->_helper->redirector('index', $this->getRequest()->getControllerName());
    	}
    	$this->view->form = $form;
    }
    
    public function addAction()
    {
    	$form = new Default_Form_Admin_SubCategory();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData ) )
    		{
    			$subCategory = new Default_Model_SubCategory();
    			$subCategory->setOptions($formData);
    			$subCategory->save();
    			
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
    	
    	$subCategory = new Default_Model_SubCategory();	
    	
    	$subCategory->find($this->_getParam('id'));
    	
    	$form = new Default_Form_Admin_SubCategory();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
	    $form->makeEdit($subCategory->getSubCategoryID());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
    		if( $form->isValid($formData ) )
    		{
    			$subCategory = new Default_Model_SubCategory();
    			$subCategory->setOptions($formData);
    			$subCategory->save();
    			
    			$this->_helper->redirector('index', $this->getRequest()->getControllerName());
       		}
    		else
    		{
    			$form->populate($formData);
    		}
    	}
    	else
    	{
    		
	    	$form->populate($subCategory->toArray());
    		
    	}
    	$this->view->form = $form;    
    }    
    
    public function getSubCategoriesByCategoryAction()
    {
    	$categoryID = $this->_getParam('categoryID');
    	$subCategory = new Default_Model_SubCategory();
    	$result = $subCategory->fetchArrayByCategoryID($categoryID);
		foreach ( $result as $subCategory )
		{
			$arr[] = array( 'label' => $subCategory->name, 'id' => $subCategory->subCategoryID );
		}
		
		
    	
    	
    	$data = array_merge( array(array('label' => 'Select Sub Category', 'id' => '')), $arr);
    	$this->_helper->json($data);
    }
    
}
