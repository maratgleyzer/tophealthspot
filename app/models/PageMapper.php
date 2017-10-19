<?php
class Default_Model_PageMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_Pages');
        }
        return $this->_dbTable;
    }
	
	public function save( Default_Model_Page $page)
	{
		
	
        $data = array(
        			'pageID'				=> $page->getPageID(),
        			'articleTitle'			=> $page->getArticleTitle(),
        			'description'			=> $page->getDescription(),
					'categoryID'			=> $page->getCategoryID(),
        			'subCategoryID'			=> $page->getSubCategoryID(),
        			'price'					=> $page->getPrice(),
        			'pageTitle'				=> $page->getPageTitle(),
        			'metaKeywords'			=> $page->getMetaKeywords(),
        			'metaDescription'		=> $page->getMetaDescription()
        );

        
        if (null === ($id = $page->getPageID())) {
            unset($data['pageID']);
            $pageID = $this->getDbTable()->insert($data);
            $page->setPageID($pageID);          
        } else {
            $this->getDbTable()->update($data, array('pageID = ?' => $data['pageID']));
        }
    }
    
    public function find($pageID, Default_Model_Page $page)
    {
    	$result = $this->getDbTable()->find( $pageID );
    	if( 0 == count($result))
    	{
    		return;
    	}	
    	
    	$row = $result->current();
    	$this->setValues($page, $row);  	
    }
    
	protected function setValues(Default_Model_Page $page, $row)
	{
		$page->setPageID($row->pageID)
					->setArticleTitle($row->articleTitle)
					->setPrice($row->price)
					->setDescription($row->description)
					->setCategoryID($row->categoryID)
					->setSubCategoryID($row->subCategoryID)
					->setPageTitle($row->pageTitle)
					->setMetaKeywords($row->metaKeywords)
					->setMetaDescription($row->metaDescription);
	}
	
	public function fetchAllAsResult()
	{
		return $this->getDbTable()->fetchAll();
	}
	
	public function fetchAllSelect()
	{
		return $this->getDbTable()->fetchAll(
			$this->getDbTable()->select()
								->from($this->getDbTable())
								
		);
	}
	
	public function fetchAllWithCatsSelect()
	{
		return $this->getDbTable()->fetchAllWithCatsSelect();
	}
}