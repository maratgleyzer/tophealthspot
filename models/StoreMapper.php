<?php
class Default_Model_StoreMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_Stores');
        }
        return $this->_dbTable;
    }
	
    public function delete($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('storeID = ?', $id ) );
    	$coupon = new Default_Model_Coupon();
    	$coupon->deleteByStore($id);
    }
    
    
	public function save( Default_Model_Store $store)
	{
        $data = array(
					'storeID'					=> $store->getStoreID(),
        			'name'						=> $store->getName(),
        			'description'				=> $store->getDescription(),
        			'secondarydescription'		=> $store->getSecondaryDescription(),
        			'pageTitle'					=> $store->getPageTitle(),
        			'url'						=> $store->getUrl(),
        			'metaKeywords'				=> $store->getMetaKeywords(),
        			'metaDescription'			=> $store->getMetaDescription()
        );

        if (null === ($id = $store->getStoreID())) {
            unset($data['storeID']);
            $storeID = $this->getDbTable()->insert($data);
            $store->setStoreID($storeID);          
        } else {
            $this->getDbTable()->update($data, array('storeID = ?' => $data['storeID']));
        }
    }
    
    public function find($storeID, Default_Model_Store $store)
    {
    	$result = $this->getDbTable()->find( $storeID );
    	if( 0 == count($result))
    	{
    		return;
    	}	
    	
    	$row = $result->current();
    	$this->setValues($store, $row);  	
    }

	public function fetchAllAsResult()
	{
		return $this->getDbTable()->fetchAll(
			$this->getDbTable()->select()->from($this->getDbTable())->order(array('name'))
		);
	}
	
	protected function setValues(Default_Model_Store $store, $row)
	{
		$store->setStoreID($row->storeID)
				->setName($row->name)
				->setDescription($row->description)
				->setSecondaryDescription($row->secondarydescription)
				->setPageTitle($row->pageTitle)
				->setMetaKeywords($row->metaKeywords)
				->setUrl($row->url)
				->setMetaDescription($row->metaDescription);
	}
	
	public function fetchAllSelect()
	{
		return $this->getDbTable()->fetchAll(
			$this->getDbTable()->select()->from($this->getDbTable())
								->order(array('name'))
								
		);
	}
}