<?php
class Default_Model_CategoryMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_Categories');
        }
        return $this->_dbTable;
    }

    public function delete($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('categoryID = ?', $id ) );
    	$subCategory = new Default_Model_SubCategory();
    	$subCategory->deleteByCategoryID($id);
    }
    
    
	public function save( Default_Model_Category $category)
	{
        $data = array(
					'categoryID'			=> $category->getCategoryID(),
        			'name'					=> htmlentities($category->getName()),
        			'pageTitle'				=> htmlentities($category->getPageTitle()),
        			'metaKeywords'			=> htmlentities($category->getMetaKeywords()),
        			'metaDescription'		=> htmlentities($category->getMetaDescription()),
        			'showInLayout'			=> htmlentities($category->getShowInLayout()),
        			'details'			=> htmlentities($category->getDetails())
        );

        if (null === ($id = $category->getCategoryID())) {
            unset($data['categoryID']);
            $categoryID = $this->getDbTable()->insert($data);
            $category->setCategoryID($categoryID);          
        } else {
            $this->getDbTable()->update($data, array('categoryID = ?' => $data['categoryID']));
        }
    }
    
    public function find($categoryID, Default_Model_Category $category)
    {
    	$result = $this->getDbTable()->find( $categoryID );
    	if( 0 == count($result))
    	{
    		return;
    	}	
    	
    	$row = $result->current();
    	$this->setValues($category, $row);  	
    }
    
	protected function setValues(Default_Model_Category $category, $row)
	{
		$category->setCategoryID($row->categoryID)
					->setName($row->name)
					->setPageTitle($row->pageTitle)
					->setMetaKeywords($row->metaKeywords)
					->setMetaDescription($row->metaDescription)
					->setShowInLayout($row->showInLayout)
					->setDetails($row->details);
	}
	
	public function fetchAllAsResult()
	{
		return $this->getDbTable()->fetchAll();
	}
	
	public function fetchAllSelect()
	{
		return $this->getDbTable()->fetchAll(
			$this->getDbTable()->select()
								->from($this->getDbTable())->order('name')
								
		);
	}
	
	
	
	
	
	public function fetchShowInLayoutArray($categoryID = null)
	{
		$results = $this->getDbTable()->fetchShowInLayout($categoryID);
		$arr = array();
		foreach( $results as $result )
		{
			$arr[$result->categoryID]['name'] = $result->name;
			$subCategory = new Default_Model_SubCategory();
			$subCatResults = $subCategory->fetchArrayByCategoryID($result->categoryID);

			if ($categoryID > 0)
			
			foreach( $subCatResults as  $subCatResult)
			{
				$arr[$result->categoryID]['subCategories'][$subCatResult->subCategoryID]['name'] =  $subCatResult['name'];
				if( $categoryID != null )
				{

					$coupon = new Default_Model_Coupon();
					$couponResults = $coupon->fetchArrayBySubCategoryID($subCatResult->subCategoryID);
					foreach( $couponResults as $coupon )
					{
						$arr[$result->categoryID]['subCategories'][$subCatResult->subCategoryID]['coupons'][$coupon->storeID] = $coupon->storeName;
					}

				}
				
			} 
		}
		return $arr;
	}
	
}