<?php
class Default_Model_DbTable_Specials extends Zend_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'specials';
    protected $_primary = 'specialID';
    
    
    public function fetchShowInLayout($specialID)
    {

    	if ($specialID > 0) 
    	{

    	return $this->fetchAll($this->select()->setIntegrityCheck(false)
	    			->from(array('sp'=>'specials'))
	    			->join( array('sc'=> 'specials_to_coupons'),
	    					'sc.specialID = sp.specialID')
		   			->join( array('c'=> 'coupons'),
		   					'c.couponID = sc.couponID and c.expirationDate > NOW()')
		   			->join( array('s'=> 'stores'),
		   					's.storeID = c.storeID',
		   					array('s.name as storeName'))
		   			->where('sc.special_to_coupon_ID = '.$specialID)
	    			->order(array('sp.name', 'c.clickcount DESC')));

    	}
    	
		else
		{
    	
    	return $this->fetchAll($this->select()->setIntegrityCheck(false)
	    			->from(array('sp'=>'specials'))
	    			->join( array('sc'=> 'specials_to_coupons'),
	    					'sc.specialID = sp.specialID')
		   			->join( array('c'=> 'coupons'),
		   					'c.couponID = sc.couponID and c.expirationDate > NOW()')
		   			->join( array('s'=> 'stores'),
		   					's.storeID = c.storeID',
		   					array('s.name as storeName'))
	    			->order(array('sp.name', 'c.clickcount DESC')));
    		    
		}
    }
}

?>