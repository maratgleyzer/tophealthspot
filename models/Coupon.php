<?php
class Default_Model_Coupon extends Default_Model_Abstract
{
	protected $_couponID;
	protected $_storeID;
	protected $_subCategoryID;
	protected $_couponTitle;
	protected $_description;
	protected $_secondaryDescription;
	protected $_couponCode;
	protected $_url;
	protected $_fullUrl;
	protected $_metaKeywords;
	protected $_metaDescription;
	protected $_details;
	protected $_expirationDate;
	protected $_featured;
	
	protected $_mapper;
	
	protected function getMapperInstance()
	{
		return new Default_Model_CouponMapper(); 
	}
	
    public function deleteByStore($id)
    {
    	$this->getMapper()->deleteByStore($id);
    }
    
    public function search($search)
    {
    	return $this->getMapper()->search($search);
    }
    
    public function deleteBySubCategoryID($id)
    {
    	$this->getMapper()->deleteBySubCategoryID($id);
    }

    public function fetchCouponsWithStoreName()
	{
		return $this->getMapper()->fetchCouponsWithStoreName();
	}
	
    public function fetchStoresWithCouponsInCategory($categoryID)
    {
    	return $this->getMapper()->fetchStoresWithCouponsInCategory($categoryID);
    }	
    
    public function fetchStoresWithCouponsInSubCategory($subCategory)
    {
    	return $this->getMapper()->fetchStoresWithCouponsInSubCategory($subCategory);
    }	
	
	public function fetchArrayBySubCategoryID($subCategoryID)
	{
		return $this->getMapper()->fetchArrayBySubCategoryID($subCategoryID);
	}
    
    
    public function fetchStoresWithCouponsAll()
    {
    	return $this->getMapper()->fetchStoresWithCouponsAll();
    }
    
	public function fetchByStoreCategory($storeID, $categoryID)
	{
		return $this->getMapper()->fetchByStoreCategory($storeID, $categoryID);
	}

	public function fetchByStoreSubCategory($storeID, $subCategoryID)
	{
		return $this->getMapper()->fetchByStoreSubCategory($storeID, $subCategoryID);
	}
	
	
	public function fetchByStore($storeID)
	{
		return $this->getMapper()->fetchByStore($storeID);
	}
	
	public function fetchFeatured( )
	{
		return $this->getMapper()->fetchFeatured();
	}
	
	
	/**
	 * @return the $_couponID
	 */
	public function getCouponID ()
	{
		return $this->_couponID;
	}

	/**
	 * @return the $_storeID
	 */
	public function getStoreID ()
	{
		return $this->_storeID;
	}

	/**
	 * @return the $_couponTitle
	 */
	public function getCouponTitle ()
	{
		return $this->_couponTitle;
	}

	/**
	 * @return the $_description
	 */
	public function getDescription ()
	{
		return $this->_description;
	}

	/**
	 * @return the $_expirationDate
	 */
	public function getExpirationDate ()
	{
		return $this->_expirationDate;
	}

	/**
	 * @param $_couponID the $_couponID to set
	 * @return Default_Model_Coupon
	 */
	public function setCouponID ($_couponID)
	{
		$this->_couponID = $_couponID;
		return $this;
	}

	/**
	 * @param $_storeID the $_storeID to set
	 * @return Default_Model_Coupon
	 */
	public function setStoreID ($_storeID)
	{
		$this->_storeID = $_storeID;
		return $this;
	}

	/**
	 * @param $_couponTitle the $_couponTitle to set
	 * @return Default_Model_Coupon
	 */
	public function setCouponTitle ($_couponTitle)
	{
		$this->_couponTitle = $_couponTitle;
		return $this;
	}

	/**
	 * @param $_description the $_description to set
	 * @return Default_Model_Coupon
	 */
	public function setDescription ($_description)
	{
		$this->_description = $_description;
		return $this;
	}

	/**
	 * @param $_expirationDate the $_expirationDate to set
	 * @return Default_Model_Coupon
	 */
	public function setExpirationDate ($_expirationDate)
	{
		$this->_expirationDate = $_expirationDate;
		return $this;
	}
	/**
	 * @return the $_couponCode
	 */
	public function getCouponCode ()
	{
		return $this->_couponCode;
	}

	/**
	 * @param $_couponCode the $_couponCode to set
	 * @return Default_Model_Coupon
	 */
	public function setCouponCode ($_couponCode)
	{
		$this->_couponCode = $_couponCode;
		return $this;
	}
	/**
	 * @return the $_secondaryDescription
	 */
	public function getSecondaryDescription ()
	{
		return $this->_secondaryDescription;
	}

	/**
	 * @param $_secondaryDescription the $_secondaryDescription to set
	 * @return Default_Model_Coupon
	 */
	public function setSecondaryDescription ($_secondaryDescription)
	{
		$this->_secondaryDescription = $_secondaryDescription;
		return $this;
	}
	/**
	 * @return the $_subCategoryID
	 */
	public function getSubCategoryID ()
	{
		return $this->_subCategoryID;
	}

	/**
	 * @param $_subCategoryID the $_subCategoryID to set
	 * @return Default_Model_Coupon
	 */
	public function setSubCategoryID ($_subCategoryID)
	{
		$this->_subCategoryID = $_subCategoryID;
		return $this;
	}
	/**
	 * @return the $_url
	 */
	public function getUrl ()
	{
		return $this->_url;
	}

	/**
	 * @param $_url the $_url to set
	 */
	public function setUrl ($_url)
	{
		$this->_url = $_url;
		return $this;
	}
	/**
	 * @return the $_details
	 */
	public function getDetails ()
	{
		return $this->_details;
	}

	/**
	 * @param $_details the $_details to set
	 * @return Default_Model_Coupon
	 */
	public function setDetails ($_details)
	{
		$this->_details = $_details;
		return $this;
	}
	/**
	 * @return the $_fullUrl
	 */
	public function getFullUrl ()
	{
		return $this->_fullUrl;
	}

	/**
	 * @return the $_metaKeywords
	 */
	public function getMetaKeywords ()
	{
		return $this->_metaKeywords;
	}

	/**
	 * @return the $_metaDescription
	 */
	public function getMetaDescription ()
	{
		return $this->_metaDescription;
	}

	/**
	 * @param $_fullUrl the $_fullUrl to set
	 * @return Default_Model_Coupon
	 */
	public function setFullUrl ($_fullUrl)
	{
		$this->_fullUrl = $_fullUrl;
		return $this;
	}

	/**
	 * @param $_metaKeywords the $_metaKeywords to set
	 * @return Default_Model_Coupon
	 */
	public function setMetaKeywords ($_metaKeywords)
	{
		$this->_metaKeywords = $_metaKeywords;
		return $this;
	}

	/**
	 * @param $_metaDescription the $_metaDescription to set
	 * @return Default_Model_Coupon
	 */
	public function setMetaDescription ($_metaDescription)
	{
		$this->_metaDescription = $_metaDescription;
		return $this;
	}
	/**
	 * @return the $_featured
	 */
	public function getFeatured ()
	{
		return $this->_featured;
	}

	/**
	 * @param $_featured the $_featured to set
	 */
	public function setFeatured ($_featured)
	{
		$this->_featured = $_featured;
		return $this;
	}



}