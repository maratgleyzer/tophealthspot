<?php
class Default_Model_ContentMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_Contents');
        }
        return $this->_dbTable;
    }
    
    public function delete($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('contentID = ?', $id ) );
    }
    
	public function save( Default_Model_Content $content)
	{
        $data = array(
        			'contentID'				=> $content->getContentID(),
        			'name'					=> $content->getName(),
        			'pageTitle'				=> $content->getPageTitle(),
        			'description'			=> $content->getDescription(),
        			'metaKeywords'			=> $content->getMetaKeywords(),
        			'metaDescription'		=> $content->getMetaDescription()
        );

        if (null === ($id = $content->getContentID())) {
            unset($data['contentID']);
            $contentID = $this->getDbTable()->insert($data);
            $content->setContentID($contentID);          
        } else {
            $this->getDbTable()->update($data, array('contentID = ?' => $data['contentID']));
        }
    }

    public function find($contentID, Default_Model_Content $content)
    {
    	$result = $this->getDbTable()->find( $contentID );
    	if( 0 == count($result))
    	{
    		return;
    	}	
    	
    	$row = $result->current();
    	$this->setValues($content, $row);  	
    }

	protected function setValues(Default_Model_Content $content, $row)
	{
		
		$content->setContentID($row->contentID)
				->setName($row->name)
				->setPageTitle($row->pageTitle)
				->setDescription($row->description)
				->setMetaDescription($row->metaDescription)
				->setMetaKeywords($row->metaKeywords);
		
	}

	public function fetchAllAsResult()
	{
		return $this->getDbTable()->fetchAll();
	}
	
	public function fetchAllSelect()
	{
		return $this->getDbTable()->select();
	}
}