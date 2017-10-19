<?php
class Default_Model_SpecialToCoupon extends Default_Model_Abstract
{
	protected $_special_to_coupon_ID;
	protected $_specialID;
	protected $_couponID;
	
	protected $_mapper;
	
	protected function getMapperInstance()
	{
		return new Default_Model_SpecialToCouponMapper(); 
	}
	
    public function deleteBySpecial($id)
    {
    	$this->getMapper()->deleteBySpecial($id);
    }
	
    public function deleteByCoupon($id)
    {
    	$this->getMapper()->deleteByCoupon($id);
    }
	
	/**
	 * @return the $_specialID
	 */
	public function getSpecialID ()
	{
		return $this->_specialID;
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
	 * @return Default_Model_SpecialToCoupon
	 */
	public function setSpecialID ($_specialID)
	{
		$this->_specialID = $_specialID;
		return $this;
	}
	
	/**
	 * @param $_couponID the $_couponID to set
	 * @return Default_Model_SpecialToCoupon
	 */
	public function setCouponID ($_couponID)
	{
		$this->_couponID = $_couponID;
		return $this;
	}		
	
}