<?php
class Default_Model_DbTable_SubCategories extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'subCategories';
    protected $_primary = 'subCategoryID';
    
    public function fetchAllWithParentSelect()
    {
    	return $this->select()->setIntegrityCheck(false)->from(array('s'=>'subCategories'))
    						->join(array('c'=>'categories'),
						's.categoryID = c.categoryID',array( 'c.name as categoryName') );
    	
    	
    	
    						
    }
    
    
    
}

?>