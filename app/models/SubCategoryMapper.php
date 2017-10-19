<?php
class Default_Model_SubCategoryMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_SubCategories');
        }
        return $this->_dbTable;
    }

    public function delete($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('subCategoryID = ?', $id ) );   	
    }

    public function deleteByCategoryID($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('categoryID = ?', $id ) );
    }
    
	public function save( Default_Model_SubCategory $subCategory )
	{
        $data = array(
        			'subCategoryID'			=> $subCategory->getSubCategoryID(),
					'categoryID'			=> $subCategory->getCategoryID(),
        			'name'					=> $subCategory->getName(),
        			'pageTitle'				=> $subCategory->getPageTitle(),
        			'metaKeywords'			=> $subCategory->getMetaKeywords(),
        			'metaDescription'		=> $subCategory->getMetaDescription(),
        			'details'				=> $subCategory->getDetails()
        );

        
        if (null === ($id = $subCategory->getSubCategoryID())) {
            unset($data['subCategoryID']);
            $subCategoryID = $this->getDbTable()->insert($data);
            $subCategory->setSubCategoryID($subCategoryID);          
        } else {
            $this->getDbTable()->update($data, array('subCategoryID = ?' => $data['subCategoryID']));
        }
    }
    
    public function find($subCategoryID, Default_Model_SubCategory $subCategory)
    {
    	$result = $this->getDbTable()->find( $subCategoryID );
    	if( 0 == count($result))
    	{
    		return;
    	}	
    	
    	$row = $result->current();
    	$this->setValues($subCategory, $row);  	
    }

	public function fetchArrayCatSubCategory()
	{
    	$results = $this->getDbTable()->fetchAll($this->getDbTable()->fetchAllWithParentSelect()->order(array('c.name', 's.name')));
    	$arr = array();
    	foreach($results as $result )
    	{
    		$result->categoryName = preg_replace('/&amp;/i','&',$result->categoryName);
    		$arr[$result->subCategoryID] = $result->categoryName . ' - ' . $result->name;
    	}
    	return $arr;
	}
    
	
	protected function setValues(Default_Model_SubCategory $subCategory, $row)
	{
		$subCategory->setSubCategoryID($row->subCategoryID)
					->setCategoryID($row->categoryID)
					->setName($row->name)
					->setPageTitle($row->pageTitle)
					->setMetaKeywords($row->metaKeywords)
					->setMetaDescription($row->metaDescription)
					->setDetails($row->details);
	}
	
	public function fetchAllSelect()
	{
		return $this->getDbTable()->fetchAll(
			$this->getDbTable()->select()
								->from($this->getDbTable())
								
		);
	}
	
	public function fetchAllWithParentSelect()
	{
		return $this->getDbTable()->fetchAllWithParentSelect();
	}
	
	public function fetchArrayByCategoryID($categoryID)
	{
		return $result = $this->getDbTable()->fetchAll($this->getDbTable()->getAdapter()->quoteInto('categoryID = ? ' , $categoryID));
	
	}
}