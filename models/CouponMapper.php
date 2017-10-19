<?php
class Default_Model_CouponMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_Coupons');
        }
        return $this->_dbTable;
    }
	
	public function save( Default_Model_Coupon $coupon)
	{
        $data = array(
        			'couponID'				=> $coupon->getCouponID(),
        			'storeID'				=> $coupon->getStoreID(),
        			'subCategoryID'			=> $coupon->getSubCategoryID(),
        			'couponTitle'			=> $coupon->getCouponTitle(),
        			'description'			=> $coupon->getDescription(),
        			'secondaryDescription'	=> $coupon->getSecondaryDescription(),
        			'couponCode'			=> $coupon->getCouponCode(),
        			'url'					=> $coupon->getUrl(),
        			'fullUrl'				=> $coupon->getFullUrl(),
        			'metaKeywords'			=> $coupon->getMetaKeywords(),
        			'metaDescription'		=> $coupon->getMetaDescription(),
        			'details'				=> $coupon->getDetails(),
        			'expirationDate'		=> $coupon->getExpirationDate(),
        			'featured'				=> $coupon->getFeatured()
        );

        //echo print_r($data);die;
        if (null === ($id = $coupon->getCouponID())) {
            unset($data['couponID']);
            $couponID = $this->getDbTable()->insert($data);
            $coupon->setCouponID($couponID);          
        } else {
            $this->getDbTable()->update($data, array('couponID = ?' => $data['couponID']));
        }
    }
    
    public function delete($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('couponID = ?', $id ) );
    }
    
    public function deleteByStore($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('storeID = ?', $id ) );
    }
    
    public function deleteBySubCategoryID($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('subCategoryID = ?', $id ) );
    }
    
    public function search($search)
    {
    	return 
    	$this->getDbTable()->select()->from($this->getDbTable())
    					
	    				->where('couponTitle LIKE \'%' . $search . '%\''
							. ' OR description LIKE \'' . $search . '\''
							. ' OR secondaryDescription LIKE \'' . $search . '\''
							. ' OR couponCode LIKE \'' . $search . '\''			
	    				);
    }
    
	public function fetchByCategoryIDStoreGrouped($categoryID)
	{
		$this->getDbTable()->fetchCouponsWithStoreName()->where('cat.category  = ? ', $categoryID);
								
	}
	
	public function fetchAllStoreGrouped()
	{
		$this->getDbTable()->fetchCouponsWithStoreName();
								
	}
	
    
    public function fetchCouponsWithStoreName()
    {
    	return $this->getDbTable()->fetchCouponsWithStoreName();
    }
    
	public function fetchByStoreCategory($storeID, $categoryID)
	{
		$results =  $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
							->from(array('c'=>'coupons'))
							->join(array('sc'=>'subCategories'),'c.subCategoryID = sc.subCategoryID')
							->where('sc.categoryID = ? ', $categoryID )
							->where('c.storeID = ? ', $storeID )
							->where('c.expirationDate > NOW()'));
		
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();
			$arr['couponID'] = $result->couponID;
			$arr['couponTitle'] = $result->couponTitle;
			$arr['couponCode'] = $result->couponCode;
			$arr['description'] = $result->description;					
			$arr['secondaryDescription'] = $result->secondaryDescription;
			$arr['url'] = $result->url;
			$arr['fullUrl'] = $result->fullUrl;
			$arr['details'] = $result->details;
			$arr['expirationDate'] = $result->expirationDate;
			$arr['featured'] = $result->featured;
			
			$brr[] = $arr;
		}
		return $brr;;
	}
	
	public function fetchByStoreSubCategory($storeID, $subCategoryID)
	{
		$results =  $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
							->from(array('c'=>'coupons'))
							->join(array('sc'=>'subCategories'),'c.subCategoryID = sc.subCategoryID')
							->where('sc.subCategoryID = ? ', $subCategoryID )
							->where('c.storeID = ? ', $storeID )
							->where('c.expirationDate > NOW()'));
		
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();
			$arr['couponID'] = $result->couponID;
			$arr['couponTitle'] = $result->couponTitle;
			$arr['couponCode'] = $result->couponCode;
			$arr['description'] = $result->description;					
			$arr['secondaryDescription'] = $result->secondaryDescription;
			$arr['url'] = $result->url;
			$arr['fullUrl'] = $result->fullUrl;
			$arr['details'] = $result->details;
			$arr['expirationDate'] = $result->expirationDate;
			$arr['featured'] = $result->featured;
			
			$brr[] = $arr;
		}
		return $brr;;
	}
	
	public function fetchByStore( $storeID )
	{
		$results =  $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
							->from(array('c'=>'coupons'))
							->join(array('sc'=>'subCategories'),'c.subCategoryID = sc.subCategoryID')
							->where('c.storeID = ? ', $storeID )
							->where('c.expirationDate > NOW()'));
		
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();
			
			$arr['couponID'] = $result->couponID;
			$arr['couponTitle'] = $result->couponTitle;
			$arr['couponCode'] = $result->couponCode;
			$arr['description'] = $result->description;					
			$arr['secondaryDescription'] = $result->secondaryDescription;
			$arr['url'] = $result->url;
			$arr['fullUrl'] = $result->fullUrl;
			$arr['details'] = $result->details;
			$arr['expirationDate'] = $result->expirationDate;
			$arr['featured'] = $result->featured;
			

			$brr[] = $arr;
			
		}
		return $brr;;
		
	}
	
	public function fetchFeatured( )
	{
		$results =  $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
							->from(array('c'=>'coupons'))
							->where('c.featured = 1')
							->where('c.expirationDate > NOW()')->limit(6));
		
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();
			
			$arr['couponID'] = $result->couponID;
			$arr['storeID'] = $result->storeID;
			$arr['couponTitle'] = $result->couponTitle;
			$arr['couponCode'] = $result->couponCode;
			$arr['description'] = $result->description;					
			$arr['secondaryDescription'] = $result->secondaryDescription;
			$arr['url'] = $result->url;
			$arr['fullUrl'] = $result->fullUrl;
			$arr['details'] = $result->details;
			$arr['expirationDate'] = $result->expirationDate;
			$arr['featured'] = $result->featured;

			$brr[] = $arr;
			
		}
		return $brr;
		
	}
	
    
    public function fetchStoresWithCouponsInCategory($categoryID)
    {
    	return $this->getDbTable()->fetchStoresWithCouponsInCategory($categoryID);
    }
    
    public function fetchStoresWithCouponsInSubCategory($subCategoryID)
    {
    	return $this->getDbTable()->fetchStoresWithCouponsInSubCategory($subCategoryID);
    }
    
    
    
    public function fetchStoresWithCouponsAll()
    {
    	return $this->getDbTable()->fetchStoresWithCouponsAll();
    }
    
    
	public function fetchArrayBySubCategoryID($subCategoryID)
	{
		return $result = $this->getDbTable()->fetchAll($this->getDbTable()->select()->where('subCategoryID = ? ', $subCategoryID)->where('expirationDate > NOW()'));
		//return $result = $this->getDbTable()->fetchAll($this->getDbTable()->getAdapter()->quoteInto('subCategoryID = ? ' , $subCategoryID));
	
	}	
    public function find($couponID, Default_Model_Coupon $coupon)
    {
    	$result = $this->getDbTable()->find( $couponID );
    	if( 0 == count($result))
    	{
    		return;
    	}	
    	
    	$row = $result->current();
    	$this->setValues($coupon, $row);  	
    }
    
	protected function setValues(Default_Model_Coupon $coupon, $row)
	{
		$coupon->setCouponID($row->couponID)
				->setStoreID($row->storeID)
				->setSubCategoryID($row->subCategoryID)
				->setCouponTitle($row->couponTitle)
				->setDescription($row->description)
				->setSecondaryDescription($row->secondaryDescription)
				->setCouponCode($row->couponCode)
				->setUrl($row->url)
				->setFullUrl($row->fullUrl)
				->setMetaKeywords($row->metaKeywords)
				->setMetaDescription($row->metaDescription)
				->setDetails($row->details)
				->setExpirationDate($row->expirationDate)
				->setFeatured($row->featured);
	}
	
	public function fetchAllAsResult()
	{
		return $this->getDbTable()->fetchAll($this->getDbTable()->select()->where('coupons.expirationDate > NOW()'));
	}
	
	public function fetchAllSelect()
	{
		return $this->getDbTable()->select()->where('coupons.expirationDate > NOW()');
	}
}