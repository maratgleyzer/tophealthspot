<?php
class Default_Model_DbTable_AdBanners extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'adBanners';
    protected $_primary = 'adBannerID';
    
    public function insert($data)
    {
    	if( isset( $data['categoryID'] ) && $data['categoryID'] == '' )
    	{
    		unset( $data['categoryID']);
    	}
    	return parent::insert($data);
    }
    
    public function update($data, $where)
    {
    	if( isset( $data['categoryID'] ) && $data['categoryID'] == '' )
    	{
    		unset( $data['categoryID']);
    	}
    	
    	return parent::update($data, $where);
    }
    
    public function fetchSelectAllWithCategory()
    {
    	return $this->select()->setIntegrityCheck(false)->from(array('ab'=>'adBanners'))
    					->joinLeft(array('c'=>'categories'), 'ab.categoryID = c.categoryID', 'IF( c.categoryID IS NULL, \'Global\', c.name) AS categoryName');
    }
    
   
}

?>