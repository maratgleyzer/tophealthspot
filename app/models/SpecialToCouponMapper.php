<?php
class Default_Model_SpecialToCouponMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_SpecialsToCoupons');
        }
        return $this->_dbTable;
    }  
    
	public function save( Default_Model_SpecialToCoupon $special_to_coupon )
	{

        $data = array(
        			'specialID'				=> $special_to_coupon->specialID,
        			'couponID'				=> $special_to_coupon->couponID
        );
        
        $special_to_coupon_ID = $this->getDbTable()->insert($data);

	}
    
    public function deleteBySpecial($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('specialID = ?', $id ) );
    }
    
    public function deleteByCoupon($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('couponID = ?', $id ) );
    }
    
}