<?php
class Default_Model_Page extends Default_Model_Abstract
{
	protected $_pageID;
	protected $_subCategoryID;
	protected $_articleTitle;
	protected $_price;
	protected $_description;
	protected $_name;
	protected $_pageTitle;
	protected $_metaKeywords;
	protected $_metaDescription;
	
	protected $_mapper;
	
	protected function getMapperInstance()
	{
		return new Default_Model_PageMapper(); 
	}

	public function fetchAllWithCatsSelect()
	{
		return $this->getMapper()->fetchAllWithCatsSelect();
	}	
	
	/**
	 * @return the $_categoryID
	 */
	public function getCategoryID ()
	{
		return $this->_subCategoryID;
	}

	/**
	 * @return the $_name
	 */
	public function getName ()
	{
		return $this->_name;
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
	 * @param $_categoryID the $_categoryID to set
	 * @return Default_Model_Page
	 */
	public function setCategoryID ($_categoryID)
	{
		$this->_subCategoryID = $_categoryID;
		return $this;
	}

	/**
	 * @param $_name the $_name to set
	 * @return Default_Model_Page
	 */
	public function setName ($_name)
	{
		$this->_name = $_name;
		return $this;
	}

		/**
	 * @param $_pageTitle the $_pageTitle to set
	 * @return Default_Model_Page
	 */
	public function setPageTitle ($_pageTitle)
	{
		$this->_pageTitle = $_pageTitle;
		return $this;
	}
	
	/**
	 * @param $_metaKeywords the $_metaKeywords to set
	 * @return Default_Model_Page
	 */
	public function setMetaKeywords ($_metaKeywords)
	{
		$this->_metaKeywords = $_metaKeywords;
		return $this;
	}

	/**
	 * @param $_metaDescription the $_metaDescription to set
	 * @return Default_Model_Page
	 */
	public function setMetaDescription ($_metaDescription)
	{
		$this->_metaDescription = $_metaDescription;
		return $this;
	}
	/**
	 * @return the $_pageID
	 */
	public function getPageID ()
	{
		return $this->_pageID;
	}

	/**
	 * @return the $_subCategoryID
	 */
	public function getSubCategoryID ()
	{
		return $this->_subCategoryID;
	}

	/**
	 * @return the $_title
	 */
	public function getArticleTitle ()
	{
		return $this->_articleTitle;
	}

	/**
	 * @return the $_price
	 */
	public function getPrice ()
	{
		return $this->_price;
	}

	/**
	 * @param $_pageID the $_pageID to set
	 * @return Default_Model_Page
	 */
	public function setPageID ($_pageID)
	{
		$this->_pageID = $_pageID;
		return $this;
	}

	/**
	 * @param $_subCategoryID the $_subCategoryID to set
	 * @return Default_Model_Page
	 */
	public function setSubCategoryID ($_subCategoryID)
	{
		$this->_subCategoryID = $_subCategoryID;
		return $this;
	}

	/**
	 * @param $_title the $_articleTitle to set
	 * @return Default_Model_Page
	 */
	public function setArticleTitle ($_title)
	{
		$this->_articleTitle = $_title;
		return $this;
	}

	/**
	 * @param $_price the $_price to set
	 * @return Default_Model_Page
	 */
	public function setPrice ($_price)
	{
		$this->_price = $_price;
		return $this;
	}
	/**
	 * @return the $_description
	 */
	public function getDescription ()
	{
		return $this->_description;
	}

	/**
	 * @param $_description the $_description to set
	 * @return Default_Model_Page
	 */
	public function setDescription ($_description)
	{
		$this->_description = $_description;
		return $this;
	}



	
}