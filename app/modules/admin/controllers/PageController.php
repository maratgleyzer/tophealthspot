<?php
class Admin_PageController extends TopHealthSpot_Admin_Controller_Action 
{
    public function indexAction()
    {	
    	$page = new Default_Model_Page();
		$paginator = Zend_Paginator::factory($page->fetchAllWithCatsSelect());
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(25);		
		$this->view->paginator = $paginator;
    }
    
    public function addAction()
    {
    	$form = new Default_Form_Admin_Page();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
	    	$form->getElement('subCategoryID')->addMultiOptions($this->fetchSubCategoryByCategory($formData['categoryID']));
    		
    		if( $form->isValid($formData ) )
    		{
    			$page = new Default_Model_Page();
    			$page->setOptions($formData)->save();
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
    	$page = new Default_Model_Page();	
    	$page->find($this->_getParam('id'));
    	
    	$form = new Default_Form_Admin_Page();
    	$form->setDecoratorPackage(new TopHealthSpot_Form_Decorator_Package_Backend());    	
    	$form->makeEdit($page->getPageID());
    	
    	if( $this->getRequest()->isPost() )
    	{
    		$formData = $this->getRequest()->getPost();
	    	$form->getElement('subCategoryID')->addMultiOptions($this->fetchSubCategoryByCategory($formData['categoryID']));
    		
    		if( $form->isValid($formData ) )
    		{
    			$page = new Default_Model_Page();
    			$page->setOptions($formData)->save();
    			$this->_helper->redirector('index', $this->getRequest()->getControllerName());
       		}
    		else
    		{
    			$form->populate($formData);
    		}
    	}
    	else
    	{
	    	$form->getElement('subCategoryID')->addMultiOptions($this->fetchSubCategoryByCategory($page->getCategoryID()));
	    	$form->getElement('subCategoryID')->setValue($page->getSubCategoryID());
	    	
 		   	$form->populate($page->toArray());
    	}
    	$this->view->form = $form;
    }

    public function favoriteThingsAction()
    {    
    	if( $this->getRequest()->isPost())
    	{
        	$favoriteThings = new Default_Model_DbTable_FavoriteThings();
    		
    		$formData = $this->getRequest()->getPost();
    		foreach( $formData as $key => $val )
    		{
    			if( $val == 1 )
    			{
    				$result = $favoriteThings->fetchAllByPageID($val);
    				if( count( $result ) < 1 )
    				{
    					$favoriteThings->insert(array('pageID'=>$key));
    				}
    			}
    			else
    			{
    				$favoriteThings->delete($favoriteThings->getAdapter()->quoteInto('pageID = ? ', $key));
    			}
    		}
    	}
    	
    	$favoriteThings = new Default_Model_DbTable_FavoriteThings();
    	$select = $favoriteThings->select()
    								->setIntegrityCheck(false)->from(array('p'=>'pages'))
    								->join(array('c'=>'categories'),'p.categoryID=c.categoryID', 'c.name AS categoryName')
    								->joinLeft(array('f'=>'favoriteThings'), 'f.pageID = p.pageID', array('IF( f.favoriteThingID IS NULL, 0, 1) AS isFavorite'));
     	
 		$paginator = Zend_Paginator::factory($select);
		$paginator->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(25);		
		$this->view->paginator = $paginator;
	}

    public function fetchSubCategoryByCategory($categoryID)
    {
    	$subCategory = new Default_Model_SubCategory();	    	
    	$result = $subCategory->fetchArrayByCategoryID($categoryID);
    	$arr = array();
    	foreach( $result as $tmpSubCategory )
    	{
    		$arr[$tmpSubCategory->subCategoryID] = $tmpSubCategory->name;
    	}
    	return $arr;
    }
}
