<?php
class Default_Model_DbTable_Coupons extends Zend_Db_Table_Abstract
{
    /** Table name */
//    protected $_name    = 'coupons';
    protected $_name    = 'coupons';
    protected $_primary = 'couponID';

    public function insert(array $data)
    {
    	$data['expirationDate'] = date('Ymd', strtotime($data['expirationDate']));
    	return parent::insert($data);
    }
    public function update(array $data, $where)
    {
    	$data['expirationDate'] = date('Ymd', strtotime($data['expirationDate']));
    	return parent::update($data, $where);
    }
    
    /*
     * @return Zend_Db_Table_Select
     */
    public function fetchCouponsWithStoreName()
    { // used in admin module
    	return $this->select()->setIntegrityCheck(false)
	    			->from(array('c'=>'coupons'))
	    			->joinLeft( array('s'=> 'stores'),
	    					'c.storeID = s.storeID',
	    					array('s.name AS storeName', 's.storeID as storeID'))
					->joinLeft(array('c2c'=>'subCategories_to_coupons'),
							'c.couponID = c2c.couponID')
					->joinLeft(array('sc'=>'subCategories'),
							'c2c.subCategoryID = sc.subCategoryID',
							'COUNT(DISTINCT(sc.subCategoryID)) AS subCategoryCount')
	    			->joinLeft( array('cat'=> 'categories'),
	    					'sc.categoryID = cat.categoryID')
	    			->joinLeft( array('s2c'=> 'specials_to_coupons'),
	    					'c.couponID = s2c.couponID',
	    					array('s2c.couponID AS SpecialCouponID'))
	    			->joinLeft( array('spec'=> 'specials'),
	    					's2c.specialID = spec.specialID',
	    				    'COUNT(DISTINCT(spec.specialID)) AS specialCount')
	    			->where('c.expirationDate > NOW()')
	    			->group('c.couponID')
	    			->order(array('s.name', 'c.couponID DESC'));
    }
    
    public function fetchStoresWithCouponsInCategory($categoryID)
    { // used in default module
    	return 
    	$this->select()->setIntegrityCheck(false)
	    			->from(array('c'=>'coupons'))
	    			->join( array('s'=> 'stores'),
	    					's.storeID = c.storeID',
	    					array('s.name AS storeName'))
					->join(array('cs'=>'subCategories_to_coupons'),
							'c.couponID = cs.couponID')
					->join(array('sc'=>'subCategories'),
							'cs.subCategoryID = sc.subCategoryID',
	    					array('sc.name AS subCategoryName'))
	    			->join( array('cat'=> 'categories'),
	    					'sc.categoryID = cat.categoryID',
	    					array('cat.name AS categoryName', 'cat.categoryID as categoryID'))
	    			->where('cat.categoryID = ? ', $categoryID)  
	    			->where('c.expirationDate > NOW()')
	    			->group('s.storeID')
	    			->order(array('c.clickcount DESC', 'storeName ASC'));
    }
    
    public function fetchStoresWithCouponsInSubCategory($subCategoryID)
    { // used in default module
    	return 
    	$this->select()->setIntegrityCheck(false)
	    			->from(array('c'=>'coupons'))
	    			->join( array('s'=> 'stores'),
	    					's.storeID = c.storeID',
	    					array('s.name AS storeName'))
					->join(array('cs'=>'subCategories_to_coupons'),
							'c.couponID = cs.couponID')
					->join(array('sc'=>'subCategories'),
							'cs.subCategoryID = sc.subCategoryID',
	    					array('sc.name AS subCategoryName'))
	    			->join( array('cat'=> 'categories'),
	    					'sc.categoryID = cat.categoryID',
	    					array('cat.name AS categoryName', 'cat.categoryID as categoryID'))
					->where('sc.subCategoryID = ? ', $subCategoryID) 
	    			->where('c.expirationDate > NOW()')
	    			->group('s.storeID')
	    			->order(array('c.clickcount DESC', 'storeName ASC'));
    }
    

    public function fetchStoresWithCouponsAll()
    { //used in default module
    	return $this->select()->setIntegrityCheck(false)
	    			->from(array('c'=>'coupons'))
	    			->join( array('s'=> 'stores'),
	    					's.storeID = c.storeID',
	    					array('s.name AS storeName'))
	    			->where('c.expirationDate > NOW()')
	    			->group('s.storeID')
	    			->order(array('c.clickcount DESC', 'storeName ASC'));
    }
    

    public function fetchStoresWithCouponsAllOrderByID()
    { //used in default module
    	return $this->select()->setIntegrityCheck(false)
	    			->from(array('c'=>'coupons'))
	    			->join( array('s'=> 'stores'),
	    					's.storeID = c.storeID',
	    					array('s.name AS storeName'))
	    			->where('c.expirationDate > NOW()')
	    			->group('s.storeID')
	    			->order(array('c.couponID DESC'));
    }
    
    
    public function fetchSubCategoriesForCouponID($couponID = null)
    {
    	
    	return $this->select()->setIntegrityCheck(false)
    				->from(array('c2c'=>'subCategories_to_coupons'))
    				->joinLeft(array('sc'=>'subCategories'),
    					   'c2c.subCategoryID = sc.subCategoryID',
    					   array('sc.subCategoryID AS THISsubCategoryID'))
    				->where('c2c.couponID = ?', $couponID);
    	
    }
    
    
    public function fetchSpecialsForCouponID($couponID = null)
    {
    	
    	return $this->select()->setIntegrityCheck(false)
    				->from(array('s2c'=>'specials_to_coupons'))
    				->joinLeft(array('s'=>'specials'),
    					   's2c.specialID = s.specialID',
    					   array('s.specialID AS specialID'))
    				->where('s2c.couponID = ?', $couponID);
    	
    }
    
    /*
    
    public function fetchCouponsByCategory($categoryID)
    {
    	return $this->select()->setIntegrityCheck(false)
    				->from(array('c'=>'coupons'))
    				->join(array('cat'=>'categories'),'cat.categoryID = c.categoryID'
    }
    */
}

?>