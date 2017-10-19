<?php
class Default_Model_Store extends Default_Model_Abstract
{
	protected $_storeID;
	protected $_name;
	protected $_description;
	protected $_secondarydescription;
	protected $_pageTitle;
	protected $_url;
	protected $_metaKeywords;
	protected $_metaDescription;
		
	protected function getMapperInstance()
	{
		return new Default_Model_StoreMapper(); 
	}
	
	public function fetchAllAsResult()
	{
   		return $this->getMapper()->fetchAllAsResult();
	}
	
	public function fetchAllAsArray()
	{
		$result = $this->getMapper()->fetchAllAsResult();
		
		$arr = array();
		foreach( $result AS $store )
		{
			$arr[$store->storeID] = $store->name;
		}
		
		return $arr;
	}
	
	/**
	 * @return the $_storeID
	 */
	public function getStoreID ()
	{
		return $this->_storeID;
	}

	/**
	 * @return the $_name
	 */
	public function getName ()
	{
		return $this->_name;
	}

	/**
	 * @return the $_description
	 */
	public function getDescription ()
	{
		return $this->_description;
	}
	
	/** MARAT
	 * @return the $_secondarydescription
	 */
	public function getSecondaryDescription ()
	{
		return $this->_secondarydescription;
	}
	
	/**
	 * @return the $_pageTitle
	 */
	public function getPageTitle ()
	{
		return $this->_pageTitle;
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
	 * @param $_storeID the $_storeID to set
	 * @return Default_Model_Store
	 */
	public function setStoreID ($_storeID)
	{
		$this->_storeID = $_storeID;
		return $this;
	}

	/**
	 * @param $_name the $_name to set
	 * @return Default_Model_Store
	 */
	public function setName ($_name)
	{
		$this->_name = $_name;
		return $this;
	}

	/**
	 * @param $_description the $_description to set
	 * @return Default_Model_Store
	 */
	public function setDescription ($_description)
	{
		$this->_description = $_description;
		return $this;
	}
	
	/** MARAT
	 * @param $_secondarydescription the $_secondarydescription to set
	 * @return Default_Model_Store
	 */
	public function setSecondaryDescription ($_secondarydescription)
	{
		$this->_secondarydescription = $_secondarydescription;
		return $this;
	}
	
	/**
	 * @param $_pageTitle the $_pageTitle to set
	 * @return Default_Model_Store
	 */
	public function setPageTitle ($_pageTitle)
	{
		$this->_pageTitle = $_pageTitle;
		return $this;
	}

	/**
	 * @param $_metaKeywords the $_metaKeywords to set
	 * @return Default_Model_Store
	 */
	public function setMetaKeywords ($_metaKeywords)
	{
		$this->_metaKeywords = $_metaKeywords;
		return $this;
	}

	/**
	 * @param $_metaDescription the $_metaDescription to set
	 * @return Default_Model_Store
	 */
	public function setMetaDescription ($_metaDescription)
	{
		$this->_metaDescription = $_metaDescription;
		return $this;
	}
	/**
	 * @return the $_url
	 * 
	 */
	public function getUrl ()
	{
		return $this->_url;
	}

	/**
	 * @param $_url the $_url to set
	 * @return Default_Model_Store
	 */
	public function setUrl ($_url)
	{
		$this->_url = $_url;
		return $this;
	}
	
}