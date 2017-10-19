<?php
class FeedController extends TopHealthSpot_Controller_ActionControllerAbstract
{
	
    public function rssXmlAction()
    {
    	$indexPage = new Default_Model_DbTable_IndexPage();
    	$row = $indexPage->find(1)->current();
    	
		$this->view->headTitle($row['pageTitle']);
		$this->view->headMeta()->appendName('keywords', $row['metaKeywords']);
		$this->view->headMeta()->appendName('description', $row['metaDescription']);

		$model = new Default_Model_Coupon();

		$stores = Zend_Paginator::factory($model->fetchStoresWithCouponsAllOrderByID());
		$stores->setCurrentPageNumber($this->_getParam('page'))->setItemCountPerPage(1000);
		
		$items = "";
		
		foreach ($stores as $store) {  
 				$coupons = $model->fetchByStore($store->storeID);
 				foreach ($coupons as $coupon) {
 					$items .=					
"<item>
<title>".htmlspecialchars(htmlspecialchars_decode($coupon['storeName']))." - ".htmlspecialchars(htmlspecialchars_decode($coupon['description'])).(strlen($coupon['secondaryDescription']) > 0 ? " - ".htmlspecialchars(htmlspecialchars_decode($coupon['secondaryDescription'])) : "")."</title>
<description>Expires: $coupon[expirationDate] / Code: ".(preg_match('/needed/i',$coupon['couponCode']) ? "------------" : $coupon['couponCode'])."</description>
<link>http://www.tophealthspot.com/coupon/$coupon[couponID]/".$this->view->titleUrl($coupon['storeName'])."/".$this->view->titleUrl($coupon['description'])."/use/1</link>
<guid>http://www.tophealthspot.com/coupon/$coupon[couponID]/".$this->view->titleUrl($coupon['storeName'])."/".$this->view->titleUrl($coupon['description'])."/use/1</guid>
</item>
";
 				}}	

		$feed =
"<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<rss version=\"2.0\">
<channel>
<generator>tophealthspot rss generator</generator>
<title>$row[pageTitle]</title>
<link>http://www.tophealthspot.com/index.php</link>
<language>en</language>
<webMaster>info@tophealthspot.com</webMaster>
<copyright>&amp;copy;2010 TopHealthSpot</copyright>
<description><![CDATA[$row[metaDescription]]]></description>
<image>
<title>TopHealthSpot</title>
<url>http://www.tophealthspot.com/assets/images/th-logo.jpg</url>
<link>http://www.tophealthspot.com/index.php</link>
</image>
$items</channel>
</rss>
";

		echo $feed;
		exit;

    }
}