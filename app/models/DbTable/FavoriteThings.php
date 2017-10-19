<?php
class Default_Model_DbTable_FavoriteThings extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'favoriteThings';
    protected $_primary = 'favoriteThingID';
    
    public function fetchAllByPageID($pageID)
    {
    	return $this->fetchAll($this->select()->from($this)->where('pageID = ?', $pageID));
    }
}

?>