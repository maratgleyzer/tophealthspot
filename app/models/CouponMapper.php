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
	
    
    public function updateClickcount( Default_Model_Coupon $coupon )
    {
    	
    	$data = array(
				'couponID'					=> $coupon->getCouponID(),
    			'clickcount'				=> $coupon->getClickcount(),
        		'expirationDate'			=> $coupon->getExpirationDate(),
    	);

    	$this->getDbTable()->update($data, array('couponID = ?' => $data['couponID']));
    	
    }
    
    
    public function updateShortened( Default_Model_Coupon $coupon )
    {
    	
    	$data = array(
				'couponID'					=> $coupon->getCouponID(),
    			'shortened'					=> $coupon->getShortened(),
        		'expirationDate'			=> $coupon->getExpirationDate(),
    	);

    	$this->getDbTable()->update($data, array('couponID = ?' => $data['couponID']));
    	
    }
    
    
    public function updateSyndicated( Default_Model_Coupon $coupon )
    {
    	
    	$data = array(
				'couponID'					=> $coupon->getCouponID(),
    			'syndicated'				=> $coupon->getSyndicated(),
        		'expirationDate'			=> $coupon->getExpirationDate(),
    	);

    	$this->getDbTable()->update($data, array('couponID = ?' => $data['couponID']));
    	
    }
    
    
	public function save( Default_Model_Coupon $coupon)
	{

        $data = array(
        			'couponID'				=> $coupon->getCouponID(),
        			'storeID'				=> $coupon->getStoreID(),
        			'couponTitle'			=> $coupon->getCouponTitle(),
        			'description'			=> $coupon->getDescription(),
        			'secondaryDescription'	=> $coupon->getSecondaryDescription(),
        			'couponCode'			=> $coupon->getCouponCode(),
        			'href'					=> $coupon->getHref(),
        			'image'					=> $coupon->getImage(),
        			'alt'					=> "",
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
    	return $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
    							  ->from( array('c'=>'coupons'))
    							  ->join( array('s'=> 'stores'),
	    							 	  's.storeID = c.storeID',
	    								  array('s.name AS storeName'))
    							  ->where('c.couponTitle LIKE \'%' . $search . '%\''
								  . ' OR c.description LIKE \'' . $search . '\''
								  . ' OR c.secondaryDescription LIKE \'' . $search . '\''
								  . ' OR c.couponCode LIKE \'' . $search . '\''			
	    ));
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
    						->join( array('s'=> 'stores'),
	    					 	    's.storeID = c.storeID',
	    						    array('s.name AS storeName'))
							->join(array('cs'=>'subCategories_to_coupons'),'c.couponID = cs.couponID')
							->join(array('sc'=>'subCategories'),'cs.subCategoryID = sc.subCategoryID')
							->where('sc.categoryID = ? ', $categoryID )
							->where('c.storeID = ? ', $storeID )
							->where('c.expirationDate > NOW()')
							->group('c.couponID')
							->order('c.clickcount DESC'));
		
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();
//			$arr['couponID'] = $result->couponID;
//			$arr['couponTitle'] = $result->couponTitle;
//			$arr['couponCode'] = $result->couponCode;
//			$arr['description'] = $result->description;					
//			$arr['secondaryDescription'] = $result->secondaryDescription;
//			$arr['url'] = $result->url;
//			$arr['fullUrl'] = $result->fullUrl;
//			$arr['details'] = $result->details;
//			$arr['expirationDate'] = $result->expirationDate;
//			$arr['featured'] = $result->featured;

			$arr['couponID'] = $result->couponID;
			$arr['storeID'] = $result->storeID;
			$arr['storeName'] = $result->storeName;
			$arr['couponTitle'] = $result->couponTitle;
			$arr['couponCode'] = $result->couponCode;
			$arr['description'] = $result->description;					
			$arr['secondaryDescription'] = $result->secondaryDescription;
			$arr['href'] = $result->href;
			$arr['image'] = $result->image;
			$arr['alt'] = $result->alt;
			$arr['clickcount'] = $result->clickcount;
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
    						->join( array('s'=> 'stores'),
	    					 	    's.storeID = c.storeID',
	    						    array('s.name AS storeName'))
							->join(array('cs'=>'subCategories_to_coupons'),'c.couponID = cs.couponID')
							->join(array('sc'=>'subCategories'),'cs.subCategoryID = sc.subCategoryID')
							->where('sc.subCategoryID = ? ', $subCategoryID )
							->where('c.storeID = ? ', $storeID )
							->where('c.expirationDate > NOW()')
							->group('c.couponID')
							->order('c.clickcount DESC'));
		
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();
//			$arr['couponID'] = $result->couponID;
//			$arr['couponTitle'] = $result->couponTitle;
//			$arr['couponCode'] = $result->couponCode;
//			$arr['description'] = $result->description;					
//			$arr['secondaryDescription'] = $result->secondaryDescription;
//			$arr['url'] = $result->url;
//			$arr['fullUrl'] = $result->fullUrl;
//			$arr['details'] = $result->details;
//			$arr['expirationDate'] = $result->expirationDate;
//			$arr['featured'] = $result->featured;

			$arr['couponID'] = $result->couponID;
			$arr['storeID'] = $result->storeID;
			$arr['storeName'] = $result->storeName;
			$arr['couponTitle'] = $result->couponTitle;
			$arr['couponCode'] = $result->couponCode;
			$arr['description'] = $result->description;					
			$arr['secondaryDescription'] = $result->secondaryDescription;
			$arr['href'] = $result->href;
			$arr['image'] = $result->image;
			$arr['alt'] = $result->alt;
			$arr['clickcount'] = $result->clickcount;
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
							->join( array('s'=> 'stores'),
	    							's.storeID = c.storeID',
	    							array('s.name AS storeName'))
							->where('c.storeID = ? ', $storeID )
							->where('c.expirationDate > NOW()')
							->order('c.clickcount DESC'));
		
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();
//			$arr['couponID'] = $result->couponID;
//			$arr['couponTitle'] = $result->couponTitle;
//			$arr['couponCode'] = $result->couponCode;
//			$arr['description'] = $result->description;					
//			$arr['secondaryDescription'] = $result->secondaryDescription;
//			$arr['url'] = $result->url;
//			$arr['fullUrl'] = $result->fullUrl;
//			$arr['details'] = $result->details;
//			$arr['expirationDate'] = $result->expirationDate;
//			$arr['featured'] = $result->featured;

			$arr['couponID'] = $result->couponID;
			$arr['storeID'] = $result->storeID;
			$arr['storeName'] = $result->storeName;
			$arr['couponTitle'] = $result->couponTitle;
			$arr['couponCode'] = $result->couponCode;
			$arr['description'] = $result->description;					
			$arr['secondaryDescription'] = $result->secondaryDescription;
			$arr['href'] = $result->href;
			$arr['image'] = $result->image;
			$arr['alt'] = $result->alt;
			$arr['clickcount'] = $result->clickcount;
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
							->join(array('s'=>'stores'),
								   'c.storeID = s.storeID',
								   array('s.name AS storeName'))
							->where('c.featured = 1')
							->where('c.expirationDate > NOW()')->limit(6)
							->order('c.clickcount DESC'));
		
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();

			$arr['couponID'] = $result->couponID;
			$arr['storeID'] = $result->storeID;
			$arr['storeName'] = $result->storeName;
			$arr['couponTitle'] = $result->couponTitle;
			$arr['couponCode'] = $result->couponCode;
			$arr['description'] = $result->description;					
			$arr['secondaryDescription'] = $result->secondaryDescription;
			$arr['href'] = $result->href;
			$arr['image'] = $result->image;
			$arr['alt'] = $result->alt;
			$arr['clickcount'] = $result->clickcount;
			$arr['details'] = $result->details;
			$arr['expirationDate'] = $result->expirationDate;
			$arr['featured'] = $result->featured;

			$brr[] = $arr;
		}
		return $brr;
		
	}
	
	public function fetchForSyndication( )
	{
		$results =  $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
							->from(array('c'=>'coupons'))
							->join(array('s'=>'stores'),
								   'c.storeID = s.storeID',
								   array('s.name AS storeName'))
							->where('c.syndicated = 0')
							->where('c.expirationDate > NOW()')
							->order('c.clickcount DESC')
							->limit(1));
		
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();

			$arr['couponID'] = $result->couponID;
			$arr['storeID'] = $result->storeID;
			$arr['storeName'] = $result->storeName;
			$arr['shortened'] = $result->shortened;
			$arr['description'] = $result->description;					

			$brr[] = $arr;
		}
		return $brr;
		
	}
	
	public function fetchRecommended($storeID) {
		$results =  $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
							->from(array('s2c'=>'subCategories_to_coupons'))
							->join(array('c'=>'coupons'),
								   's2c.couponID = c.couponID')
							->where('c.storeID = ? ', $storeID)
							->where('c.expirationDate > NOW()')
							->group('s2c.subCategoryID'));
		
		$cats = array();
		foreach($results as $result)
			$cats['subCategory'] = $result->subCategoryID;

		$inclause = implode(", ",$cats);

		$results =  $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
							->from(array('s2c'=>'subCategories_to_coupons'))
							->join(array('c'=>'coupons'),
								   's2c.couponID = c.couponID')
							->join(array('s'=>'stores'),
								   'c.storeID = s.storeID',
								   array('s.name AS storeName'))
							->where('s2c.subCategoryID IN (?)', $inclause)
							->where('c.storeID <> ?', $storeID)
							->where('c.expirationDate > NOW()')
							->group('c.couponID')
							->order('c.clickcount DESC'));
							
		$brr = array();
		foreach($results as $result)
		{
			$arr = array();
			$arr['couponID'] = $result->couponID;
			$arr['storeID'] = $result->storeID;
			$arr['storeName'] = $result->storeName;
			$arr['couponTitle'] = $result->couponTitle;
			$arr['couponCode'] = $result->couponCode;
			$arr['description'] = $result->description;					
			$arr['secondaryDescription'] = $result->secondaryDescription;
			$arr['href'] = $result->href;
			$arr['image'] = $result->image;
			$arr['alt'] = $result->alt;
			$arr['clickcount'] = $result->clickcount;
			$arr['details'] = $result->details;
			$arr['expirationDate'] = $result->expirationDate;
			$arr['featured'] = $result->featured;

			$brr[] = $arr;
		}
		return $brr;
	}
	
	public function fetchStoresHavingCoupons( )
	{
		
		$arr = array();
		
		$results =  $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
							->from(array('c'=>'coupons'))
							->join(array('s'=>'stores'),'c.storeID = s.storeID')
							->where('c.expirationDate > NOW()')
							->group('s.storeID')
							->order('s.name'));
		
		$brr = array();
		
		foreach($results as $result)
		{
			$arr = array();

			$arr['storeID'] = $result->storeID;
			$arr['storeName'] = $result->name;

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
    
    public function fetchSubCategoriesForCouponID($couponID)
    {
    	
    	$arr = array();
    	
    	$results = $this->getDbTable()->fetchAll($this->getDbTable()->fetchSubCategoriesForCouponID($couponID));
    	foreach($results as $result)
    	{
    		$arr[] = $result->subCategoryID;
    	}
    	
    	return $arr;

    }
    
    public function fetchSpecialsForCouponID($couponID)
    {
    	
    	$arr = array();
    	
    	$results = $this->getDbTable()->fetchAll($this->getDbTable()->fetchSpecialsForCouponID($couponID));
    	foreach($results as $result)
    	{
    		$arr[] = $result->specialID;
    	}
    	
    	return $arr;

    }
    
    public function fetchStoresWithCouponsAll()
    {
    	return $this->getDbTable()->fetchStoresWithCouponsAll();
    }
    
    public function fetchStoresWithCouponsAllOrderByID()
    {
    	return $this->getDbTable()->fetchStoresWithCouponsAllOrderByID();
    }
    
	public function fetchArrayBySubCategoryID($subCategoryID)
	{
		return $result = $this->getDbTable()->fetchAll($this->getDbTable()->select()->setIntegrityCheck(false)
							  ->from(array('c'=>'coupons'))
							  ->join(array('s'=>'stores'),'c.storeID = s.storeID',array('s.name AS storeName'))
							  ->join(array('cs'=>'subCategories_to_coupons'),'c.couponID = cs.couponID')
							  ->join(array('sc'=>'subCategories'),'cs.subCategoryID = sc.subCategoryID')
							  ->where('sc.subCategoryID = ? ', $subCategoryID)
							  ->where('c.expirationDate > NOW()')
							  ->group('c.storeID')
							  ->order('storeName'));
							  //->order('c.clickcount DESC'));
		//return $result = $this->getDbTable()->fetchAll($this->getDbTable()->getAdapter()->quoteInto('subCategoryID = ? ' , $subCategoryID));
	
	}	
    public function find($couponID, Default_Model_Coupon $coupon)
    {
    	$result = $this->getDbTable()->find( $couponID );
    	if( 0 == count($result))
    	{
    		return;
    	}	

		$subcategories = $this->fetchSubCategoriesForCouponID( $couponID );
		$specials = $this->fetchSpecialsForCouponID( $couponID );
		
    	$row = $result->current();
    	$this->setValues($coupon, $row, $subcategories, $specials);  	
    }
    
	protected function setValues(Default_Model_Coupon $coupon, $row, $subcategories, $specials)
	{

		$coupon->setCouponID($row->couponID)
				->setStoreID($row->storeID)
				->setSubCategoryID($subcategories)
				->setSpecialID($specials)
				->setCouponTitle($row->couponTitle)
				->setDescription($row->description)
				->setSecondaryDescription($row->secondaryDescription)
				->setCouponCode($row->couponCode)
				->setHref($row->href)
				->setImage($row->image)
				->setAlt($row->alt)
				->setClickcount($row->clickcount)
				->setMetaKeywords($row->metaKeywords)
				->setMetaDescription($row->metaDescription)
				->setDetails($row->details)
				->setExpirationDate($row->expirationDate)
				->setFeatured($row->featured);
	}
	
	public function fetchAllAsResult()
	{
		return $this->getDbTable()->fetchAll($this->getDbTable()->select()->where('coupons.expirationDate > NOW()')->order('coupons.clickcount DESC'));
	}
	
	public function fetchAllSelect()
	{
		return $this->getDbTable()->select()->where('coupons.expirationDate > NOW()')->order('coupons.clickcount DESC');
	}
}