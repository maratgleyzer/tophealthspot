<?php
class Default_Model_DbTable_Coupons extends Zend_Db_Table_Abstract
{
    /** Table name */
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
    {
    	return $this->select()->setIntegrityCheck(false)
	    			->from(array('c'=>'coupons'))
	    			->join( array('s'=> 'stores'),
	    					's.storeID = c.storeID',
	    					array('s.name AS storeName', 's.storeID as storeID'))
	    			->join( array('sc'=> 'subCategories'),
	    					'sc.subCategoryID = c.subCategoryID',
	    					array('sc.name AS subCategoryName'))
	    			->join( array('cat'=> 'categories'),
	    					'sc.categoryID = cat.categoryID',
	    					array('cat.name AS categoryName'))
	    			->where('c.expirationDate > NOW()')
	    			->order(array('s.name ASC', 'cat.name ASC'));
    }
    
    public function fetchStoresWithCouponsInCategory($categoryID)
    {
    	return 
    	$this->select()->setIntegrityCheck(false)
	    			->from(array('c'=>'coupons'))
	    			->join( array('s'=> 'stores'),
	    					's.storeID = c.storeID',
	    					array('s.name AS storeName'))
	    			->join( array('sc'=> 'subCategories'),
	    					'sc.subCategoryID = c.subCategoryID',
	    					array('sc.name AS subCategoryName'))
	    					
	    			->join( array('cat'=> 'categories'),
	    					'sc.categoryID = cat.categoryID',
	    					array('cat.name AS categoryName', 'cat.categoryID as categoryID'))
	    			->where('cat.categoryID = ? ', $categoryID)  
	    			->where('c.expirationDate > NOW()')
	    			->group('s.storeID')
	    			->order('storeName ASC');
    }
    
    public function fetchStoresWithCouponsInSubCategory($subCategoryID)
    {
    	return 
    	$this->select()->setIntegrityCheck(false)
	    			->from(array('c'=>'coupons'))
	    			->join( array('s'=> 'stores'),
	    					's.storeID = c.storeID',
	    					array('s.name AS storeName'))
	    			->join( array('sc'=> 'subCategories'),
	    					'sc.subCategoryID = c.subCategoryID',
	    					array('sc.name AS subCategoryName'))
	    					
	    			->join( array('cat'=> 'categories'),
	    					'sc.categoryID = cat.categoryID',
	    					array('cat.name AS categoryName', 'cat.categoryID as categoryID'))
	    			//->columns(array('sc.subCategoryID as subCategoryID'))
	    			->where('c.subCategoryID = ? ', $subCategoryID)  
	    			->where('c.expirationDate > NOW()')
	    			->group('s.storeID')
	    			->order('storeName ASC');
    }
    

    public function fetchStoresWithCouponsAll()
    {
    	return $this->select()->setIntegrityCheck(false)
	    			->from(array('c'=>'coupons'))
	    			->join( array('s'=> 'stores'),
	    					's.storeID = c.storeID',
	    					array('s.name AS storeName'))
	    			->join( array('sc'=> 'subCategories'),
	    					'sc.subCategoryID = c.subCategoryID',
	    					array('sc.name AS subCategoryName'))
	    					
	    			->join( array('cat'=> 'categories'),
	    					'sc.categoryID = cat.categoryID',
	    					array('cat.name AS categoryName', 'cat.categoryID as categoryID'))
	    			->having('c.expirationDate > NOW()')
	    			->group('s.storeID')
	    			->order('storeName ASC');
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