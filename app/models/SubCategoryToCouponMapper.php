<?php
class Default_Model_SubCategoryToCouponMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_SubCategoriesToCoupons');
        }
        return $this->_dbTable;
    }  
    
	public function save( Default_Model_SubCategoryToCoupon $subCategory_to_coupon )
	{

        $data = array(
        			'subCategoryID'			=> $subCategory_to_coupon->subCategoryID,
        			'couponID'				=> $subCategory_to_coupon->couponID
        );
        
        $subCategory_to_coupon_ID = $this->getDbTable()->insert($data);

	}
    
    public function deleteBySubCategory($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('subCategoryID = ?', $id ) );
    }
    
    public function deleteByCoupon($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('couponID = ?', $id ) );
    }
    
}