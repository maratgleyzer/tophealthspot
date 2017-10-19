<?php
class Default_Model_SpecialMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_Specials');
        }
        return $this->_dbTable;
    }

    public function delete($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('specialID = ?', $id ) );
    }
    
    
	public function save( Default_Model_Special $special)
	{
        $data = array(
					'specialID'				=> $special->getSpecialID(),
        			'name'					=> htmlentities($special->getName()),
        			'pageTitle'				=> htmlentities($special->getPageTitle()),
        			'metaKeywords'			=> htmlentities($special->getMetaKeywords()),
        			'metaDescription'		=> htmlentities($special->getMetaDescription()),
        			'showInLayout'			=> htmlentities($special->getShowInLayout()),
        			'details'				=> htmlentities($special->getDetails())
        );

        if (null === ($id = $special->getSpecialID())) {
            unset($data['specialID']);
            $specialID = $this->getDbTable()->insert($data);
            $special->setSpecialID($specialID);          
        } else {
            $this->getDbTable()->update($data, array('specialID = ?' => $data['specialID']));
        }
    }
    
    public function find($specialID, Default_Model_Special $special)
    {
    	$result = $this->getDbTable()->find( $specialID );
    	if( 0 == count($result))
    	{
    		return;
    	}	
    	
    	$row = $result->current();
    	$this->setValues($special, $row);  	
    }
    
	protected function setValues(Default_Model_Special $special, $row)
	{
		$special->setSpecialID($row->specialID)
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
	
	public function fetchShowInLayoutArray($specialID = null)
	{
		$results = $this->getDbTable()->fetchShowInLayout($specialID);
		$arr = array();
		foreach( $results as $result )
		{
			$arr[$result->specialID]['name'] = $result->name;

			$arr[$result->specialID]['coupons'][$result->couponID]['description'] =  $result['description'];
			$arr[$result->specialID]['coupons'][$result->couponID]['couponID'] =  $result['couponID'];
			$arr[$result->specialID]['coupons'][$result->couponID]['storeName'] =  $result['storeName'];
			
		}
		return $arr;
	}
	
}