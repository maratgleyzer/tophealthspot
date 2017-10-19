<?php
class SyndicationController extends TopHealthSpot_Controller_ActionControllerAbstract
{
	
    public function indexAction()
    {

		$model = new Default_Model_Coupon();

		$coupon = $model->fetchForSyndication();
//var_dump($coupon); exit;
		if (is_array($coupon) &&
			isset($coupon[0]['couponID']) &&
			($coupon[0]['couponID'] > 0)) {

			$coupon = $coupon[0];
			$model->find($coupon['couponID']);
			$model->setSyndicated('1');
			
			$storename = ltrim(rtrim($coupon['storeName']));
			$description = ltrim(rtrim($coupon['description']));

			if (strlen($coupon['shortened']) == 0) {
				
				$url = "http://www.tophealthspot.com/store/$coupon[storeID]/".$this->view->titleUrl($storename);
				$this->data_url = "http://api.bit.ly/shorten?version=2.0.1&longUrl=".urlencode($url)."&login=tophealthspot&apiKey=R_a06ea58e406e7de8a1c600de8560de80";
				$json = $this->CurlBitly(); $data = json_decode($json, true);
				$tiny = $data['results'][$url]['shortUrl'];
				
				$model->setShortened($tiny);
				$model->updateShortened($model);
				
			}
				
			else { $tiny = $coupon['shortened']; }
				
			$message = substr(html_entity_decode($storename." - ".$description),0,110)."... $tiny";

			if (mail('kzyok7@ping.fm', 'New Ping Post', $message, ''))
				$model->updateSyndicated($model);
			
   		}
   		
   		exit;

    }
        
    private function CurlBitly()
	{

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->data_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $data = curl_exec($ch);
        
		curl_close($ch);
		
		return $data;

	}
    
}