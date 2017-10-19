<?php
class Default_Model_AdBannerMapper extends Default_Model_MapperAbstract
{
	public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Default_Model_DbTable_AdBanners');
        }
        return $this->_dbTable;
    }
    public function delete($id)
    { 
    	$this->getDbTable()->delete($this->getDbTable()->getAdapter()->quoteInto('adBannerID = ?', $id ) );
    }
    
    
	public function save( Default_Model_AdBanner $adBanner)
	{
//        $data = array(
//					'adBannerID'			=> $adBanner->getAdBannerID(),
//        			'categoryID'			=> $adBanner->getCategoryID(),
//        			'url'					=> $adBanner->getUrl(),
//        			'dimensions'			=> $adBanner->getDimensions(),
//        			'order'					=> $adBanner->getOrder()
//        );

        $data = array(
					'adBannerID'			=> $adBanner->getAdBannerID(),
        			'categoryID'			=> $adBanner->getCategoryID(),
        			'height'				=> $adBanner->getHeight(),
        			'width'					=> $adBanner->getWidth(),
        			'image'					=> $adBanner->getImage(),
        			'href'					=> $adBanner->getHref(),
        			'alt'					=> $adBanner->getAlt(),
        			'order'					=> $adBanner->getOrder()
        );
		
        if (null === ($id = $adBanner->getAdBannerID())) {
            unset($data['adBannerID']);
            $adBannerID = $this->getDbTable()->insert($data);
            $adBanner->setAdBannerID($adBannerID);          
        } else {
            $this->getDbTable()->update($data, array('adBannerID = ?' => $data['adBannerID']));
        }
    }
    
    public function find($adBannerID, Default_Model_AdBanner $adBanner)
    {
    	$result = $this->getDbTable()->find( $adBannerID );
    	if( 0 == count($result))
    	{
    		return;
    	}	
    	
    	$row = $result->current();
    	$this->setValues($adBanner, $row);  	
    }
    
	protected function setValues(Default_Model_AdBanner $adBanner, $row)
	{
//		$adBanner->setAdBannerID($row->adBannerID)
//					->setCategoryID($row->categoryID)
//					->setUrl($row->url)
//					->setDimensions($row->dimensions)
//					->setOrder($row->order);

		$adBanner->setAdBannerID($row->adBannerID)
					->setCategoryID($row->categoryID)
					->setHeight($row->height)
					->setWidth($row->width)
					->setImage($row->image)
					->setHref($row->href)
					->setAlt($row->alt)
					->setOrder($row->order);
	}
	
	public function fetchAllAsResult()
	{
		return $this->getDbTable()->fetchAll();
	}
	
	public function fetchAllSelect()
	{
		return $this->getDbTable()->fetchAll(
			$this->getDbTable()->select()
								->from($this->getDbTable())
								
		);
	}	
	
	public function fetchAllGlobal()
	{
		$results = $this->getDbTable()->fetchAll('categoryID IS NULL', 'order', 10);
		$arr = array();
		foreach( $results as $result )
		{
//			$arr[] = array( 'dimensions'=>$result->dimensions, 'url'=>$result->url, 'adBannerID'=>$result->adBannerID); 
			$arr[] = array( 'height'=>$result->height, 'width'=>$result->width, 'image'=>$result->image, 'href'=>$result->href, 'alt'=>$result->alt, 'adBannerID'=>$result->adBannerID);
		}
		return $arr;
	}

	
	public function fetchAllByCategory($categoryID)
	{
		$where = $this->getDbTable()->getAdapter()->quoteInto('categoryID = ? ', $categoryID);
		$results = $this->getDbTable()->fetchAll($where, 'order', 6);
		$arr = array();
		foreach( $results as $result )
		{
//			$arr[] = array( 'dimensions'=>$result->dimensions, 'url'=>$result->url, 'adBannerID'=>$result->adBannerID);
			$arr[] = array( 'height'=>$result->height, 'width'=>$result->width, 'image'=>$result->image, 'href'=>$result->href, 'alt'=>$result->alt, 'adBannerID'=>$result->adBannerID); 	
		}
		return $arr;
	}
	
	
	
	
	public function fetchSelectAllWithCategory()
	{
		return $this->getDbTable()->fetchSelectAllWithCategory();
	}
}