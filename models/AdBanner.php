<?php
class Default_Model_AdBanner extends Default_Model_Abstract
{
	protected $_adBannerID;
	protected $_subCategoryID;
	protected $_height;
	protected $_width;
	protected $_image;
	protected $_href;
	protected $_alt;
//	protected $_url;
//	protected $_dimensions;
	protected $_order;
	
	protected function getMapperInstance()
	{
		return new Default_Model_AdBannerMapper();  
	}
	
	public function fetchSelectAllWithCategory()
	{
		return $this->getMapper()->fetchSelectAllWithCategory();
	}
	
	public function fetchAllGlobal()
	{
		return $this->getMapper()->fetchAllGlobal();
	}
	
	public function fetchAllByCategory($categoryID)
	{
		return $this->getMapper()->fetchAllByCategory($categoryID);
	}
	/**
	 * @return the $_adBannerID
	 */
	public function getAdBannerID ()
	{
		return $this->_adBannerID;
	}

	/**
	 * @return the $_categoryID
	 */
	public function getCategoryID ()
	{
		return $this->_subCategoryID;
	}

	/**
	 * @return the $_url
	 */
//	public function getUrl ()
//	{
//		return $this->_url;
//	}

	/**
	 * @return the $_order
	 */
	public function getOrder ()
	{
		return $this->_order;
	}

	/**
	 * @param $_adBannerID the $_adBannerID to set
	 * @return Default_Model_AdBanner
	 */
	public function setAdBannerID ($_adBannerID)
	{
		$this->_adBannerID = $_adBannerID;
		return $this;
	}

	/**
	 * @param $_categoryID the $_categoryID to set
	 * @return Default_Model_AdBanner
	 */
	public function setCategoryID ($_categoryID)
	{
		$this->_subCategoryID = $_categoryID;
		return $this;
	}

	/**
	 * @param $_url the $_url to set
	 * @return Default_Model_AdBanner
	 */
//	public function setUrl ($_url)
//	{
//		$this->_url = $_url;
//		return $this;
//	}

	/**
	 * @param $_order the $_order to set
	 * @return Default_Model_AdBanner
	 */
	public function setOrder ($_order)
	{
		$this->_order = $_order;
		return $this;
	}
	/**
	 * @return the $_dimensions
	 */
//	public function getDimensions ()
//	{
//		return $this->_dimensions;
//	}

	/**
	 * @param $_dimensions the $_dimensions to set
	 * @return Default_Model_AdBanner
	 */
//	public function setDimensions ($_dimensions)
//	{
//		$this->_dimensions = $_dimensions;
//		return $this;
//	}
	
	/** MARAT
	 * @return the $_height
	 */
	public function getHeight ()
	{
		return $this->_height;
	}
	
	/** MARAT
	 * @return the $_width
	 */
	public function getWidth ()
	{
		return $this->_width;
	}
		
	/** MARAT
	 * @return the $_image
	 */
	public function getImage ()
	{
		return $this->_image;
	}
	
	/** MARAT
	 * @return the $_href
	 */
	public function getHref ()
	{
		return $this->_href;
	}
	
	/** MARAT
	 * @return the $_alt
	 */
	public function getAlt ()
	{
		return $this->_alt;
	}
	
	/** MARAT
	 * @param $_height the $_height to set
	 * @return Default_Model_AdBanner
	 */
	public function setHeight ($_height)
	{
		$this->_height = $_height;
		return $this;
	}
	
	/** MARAT
	 * @param $_width the $_width to set
	 * @return Default_Model_AdBanner
	 */
	public function setWidth ($_width)
	{
		$this->_width = $_width;
		return $this;
	}
	
	/** MARAT
	 * @param $_image the $_image to set
	 * @return Default_Model_AdBanner
	 */
	public function setImage ($_image)
	{
		$this->_image = $_image;
		return $this;
	}
		
	/** MARAT
	 * @param $_href the $_href to set
	 * @return Default_Model_AdBanner
	 */
	public function setHref ($_href)
	{
		$this->_href = $_href;
		return $this;
	}
	
	/** MARAT
	 * @param $_alt the $_alt to set
	 * @return Default_Model_AdBanner
	 */
	public function setAlt ($_alt)
	{
		$this->_alt = $_alt;
		return $this;
	}
	

	

}