<?php
class Default_Model_SubCategory extends Default_Model_Abstract
{
	protected $_subCategoryID;
	protected $_categoryID;
	
	protected $_name;
	protected $_pageTitle;
	protected $_metaKeywords;
	protected $_metaDescription;
	protected $_details;
	
	protected $_mapper;
	
	protected function getMapperInstance()
	{
		return new Default_Model_SubCategoryMapper();  
	}
	
    public function deleteByCategoryID($id)
    {
    	return $this->getMapper()->deleteByCategoryID($id);
    }
	
	public function fetchArrayByCategoryID($categoryID)
	{
		return $this->getMapper()->fetchArrayByCategoryID($categoryID);
	}	
	
	public function fetchAllWithParentSelect()
	{
		return $this->getMapper()->fetchAllWithParentSelect();
	}
	
	public function fetchArrayCatSubCategory()
	{
		return $this->getMapper()->fetchArrayCatSubCategory();
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
	 * @param $_name the $_name to set
	 * @return Default_Model_SubCategory
	 */
	public function setName ($_name)
	{
		$this->_name = $_name;
		return $this;
	}

		/**
	 * @param $_pageTitle the $_pageTitle to set
	 * @return Default_Model_SubCategory
	 */
	public function setPageTitle ($_pageTitle)
	{
		$this->_pageTitle = $_pageTitle;
		return $this;
	}
	
	/**
	 * @param $_metaKeywords the $_metaKeywords to set
	 * @return Default_Model_SubCategory
	 */
	public function setMetaKeywords ($_metaKeywords)
	{
		$this->_metaKeywords = $_metaKeywords;
		return $this;
	}

	/**
	 * @param $_metaDescription the $_metaDescription to set
	 * @return Default_Model_SubCategory
	 */
	public function setMetaDescription ($_metaDescription)
	{
		$this->_metaDescription = $_metaDescription;
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
	 * @return Default_Model_SubCategory
	 */
	public function setSubCategoryID ($_subCategoryID)
	{
		$this->_subCategoryID = $_subCategoryID;
		return $this;
	}
	/**
	 * @return the $_categoryID
	 */
	public function getCategoryID ()
	{
		return $this->_categoryID;
	}

	/**
	 * @param $_categoryID the $_categoryID to set
	 */
	public function setCategoryID ($_categoryID)
	{
		$this->_categoryID = $_categoryID;
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