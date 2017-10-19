<?php
class Default_Model_DbTable_Categories extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'categories';
    protected $_primary = 'categoryID';
    
    
    public function fetchShowInLayout($categoryID)
    {
    	return ( $categoryID == null ) ? $this->fetchAll($this->select()->from($this)->where('showInLayout =  ?', true ))
    						: $this->fetchAll($this->select()->from($this)->where('categoryID = ?', $categoryID)->limit(7));
    			
    			
    }
}

?>