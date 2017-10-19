<?php
class Default_Model_Content extends Default_Model_Abstract
{
	protected $_contentID;
	protected $_name;
	protected $_pageTitle;
	protected $_metaKeywords;
	protected $_metaDescription;
	protected $_description;

	protected function getMapperInstance()
	{
		return new Default_Model_ContentMapper();  
	}
	
	public function fetchAllAsArray()
	{
		$result = $this->getMapper()->fetchAllAsResult();
		
		$arr = array();
		foreach( $result AS $cat )
		{
			$arr[$cat->contentID] = $cat->name;
		}
		
		return $arr;
	}
	/**
	 * @return the $_contentID
	 */
	public function getContentID ()
	{
		return $this->_contentID;
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
	 * @return the $_description
	 */
	public function getDescription ()
	{
		return $this->_description;
	}

	/**
	 * @param $_contentID the $_contentID to set
	 * @return Default_Model_Content
	 */
	public function setContentID ($_contentID)
	{
		$this->_contentID = $_contentID;
		return $this;
	}

	/**
	 * @param $_name the $_name to set
	 * @return Default_Model_Content
	 */
	public function setName ($_name)
	{
		$this->_name = $_name;
		return $this;
	}

	/**
	 * @param $_pageTitle the $_pageTitle to set
	 * @return Default_Model_Content
	 */
	public function setPageTitle ($_pageTitle)
	{
		$this->_pageTitle = $_pageTitle;
		return $this;
	}

	/**
	 * @param $_metaKeywords the $_metaKeywords to set
	 * @return Default_Model_Content
	 */
	public function setMetaKeywords ($_metaKeywords)
	{
		$this->_metaKeywords = $_metaKeywords;
		return $this;
	}

	/**
	 * @param $_metaDescription the $_metaDescription to set
	 * @return Default_Model_Content
	 */
	public function setMetaDescription ($_metaDescription)
	{
		$this->_metaDescription = $_metaDescription;
		return $this;
	}

	/**
	 * @param $_description the $_description to set
	 * @return Default_Model_Content
	 */
	public function setDescription ($_description)
	{
		$this->_description = $_description;
		return $this;
	}
	
}