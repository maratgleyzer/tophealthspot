<?php
class Default_Model_DbTable_Pages extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'pages';
    protected $_primary = 'pageID';
    


    public function fetchAllWithCatsSelect()
    {
    	return $this->select()->setIntegrityCheck(false)->from(array('p'=>'pages'))
    						->join(array('c'=>'categories'),
						'p.categoryID = c.categoryID',array( 'c.name as categoryName') )
    						->join(array('s'=>'subCategories'),
						'p.subCategoryID = s.subCategoryID',array( 's.name as subCategoryName') );
    	
    	
    	
    						
    }
}
?>