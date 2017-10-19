<?php
class Default_Model_Category extends Default_Model_Abstract
{
	protected $_subCategoryID;
	protected $_name;
	protected $_pageTitle;
	protected $_metaKeywords;
	protected $_metaDescription;
	protected $_details;
	
	protected $_showInLayout;
	protected $_mapper;
	
	protected function getMapperInstance()
	{
		return new Default_Model_CategoryMapper(); 
	}
	/**
	 * @return the $_categoryID
	 */
	public function getCategoryID ()
	{
		return $this->_subCategoryID;
	}

	public function fetchShowInLayoutArray($category)
	{
		return $this->getMapper()->fetchShowInLayoutArray($category);
	}
	
	public function fetchAllAsArray()
	{
		$result = $this->getMapper()->fetchAllAsResult();
		
		$arr = array();
		foreach( $result AS $cat )
		{
			$arr[$cat->categoryID] = $cat->name;
		}
		
		return $arr;
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
	 * @return Default_Model_Category
	 */
	public function setCategoryID ($_categoryID)
	{
		$this->_subCategoryID = $_categoryID;
		return $this;
	}

	/**
	 * @param $_name the $_name to set
	 * @return Default_Model_Category
	 */
	public function setName ($_name)
	{
		$this->_name = $_name;
		return $this;
	}

		/**
	 * @param $_pageTitle the $_pageTitle to set
	 * @return Default_Model_Category
	 */
	public function setPageTitle ($_pageTitle)
	{
		$this->_pageTitle = $_pageTitle;
		return $this;
	}
	
	/**
	 * @param $_metaKeywords the $_metaKeywords to set
	 * @return Default_Model_Category
	 */
	public function setMetaKeywords ($_metaKeywords)
	{
		$this->_metaKeywords = $_metaKeywords;
		return $this;
	}

	/**
	 * @param $_metaDescription the $_metaDescription to set
	 * @return Default_Model_Category
	 */
	public function setMetaDescription ($_metaDescription)
	{
		$this->_metaDescription = $_metaDescription;
		return $this;
	}
	/**
	 * @return the $_showInLayout
	 */
	public function getShowInLayout ()
	{
		return $this->_showInLayout;
	}

	/**
	 * @param $_showInLayout the $_showInLayout to set
	 * @return Default_Model_Category
	 */
	public function setShowInLayout ($_showInLayout)
	{
		$this->_showInLayout = $_showInLayout;
		return $this;
	}
	/**
	 * @return the $_description
	 */
	public function getDetails ()
	{
		return $this->_details;
	}

	/**
	 * @param $_description the $_description to set
	 */
	public function setDetails ($_details)
	{
		$this->_details = $_details;
		return $this;
	}



	
}