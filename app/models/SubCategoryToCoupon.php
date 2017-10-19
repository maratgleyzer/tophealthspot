<?php
class Default_Model_SubCategoryToCoupon extends Default_Model_Abstract
{
	protected $_subCategory_to_coupon_ID;
	protected $_subCategoryID;
	protected $_couponID;
	
	protected $_mapper;
	
	protected function getMapperInstance()
	{
		return new Default_Model_SubCategoryToCouponMapper(); 
	}
	
    public function deleteBySubCategory($id)
    {
    	$this->getMapper()->deleteBySubCategory($id);
    }
	
    public function deleteByCoupon($id)
    {
    	$this->getMapper()->deleteByCoupon($id);
    }
	
	/**
	 * @return the $_subCategoryID
	 */
	public function getSubCategoryID ()
	{
		return $this->_subCategoryID;
	}
    
	/**
	 * @return the $_couponID
	 */
	public function getCouponID ()
	{
		return $this->_couponID;
	}

	/**
	 * @param $_specialID the $_specialID to set
	 * @return Default_Model_SubCategoryToCoupon
	 */
	public function setSubCategoryID ($_subCategoryID)
	{
		$this->_subCategoryID = $_subCategoryID;
		return $this;
	}
	
	/**
	 * @param $_couponID the $_couponID to set
	 * @return Default_Model_SubCategoryToCoupon
	 */
	public function setCouponID ($_couponID)
	{
		$this->_couponID = $_couponID;
		return $this;
	}		
	
}