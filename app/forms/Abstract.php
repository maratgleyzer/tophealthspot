<?php
class Default_Form_Abstract extends Zend_Form
{
	protected $_decoratorPackage;

    public function getGeneralElements()
    {
    	return $this->_generalElements;
    }

    public function getCheckboxElements()
    {
    	return $this->_checkboxElements;
    }

    public function getHiddenElements()
    {
    	return $this->_hiddenElements;
    }
    
    public function getFileElements()
    {
    	return $this->_fileElements;
    }
    
    public function getJQueryElements()
    {
    	return $this->_jQueryElements;
    }
    
    public function getButtonElements()
    {
    	return $this->_buttonElements;
    }
           
    public function setDecoratorPackage($decoratorPackage)
    {
    	$this->_decoratorPackage = $decoratorPackage;
    	$this->_decoratorPackage->apply($this);
    	
    }
    
    public function applyDecoratorPackage()
    {
    	$this->_decoratorPackage->apply($this);
    }
    	
	protected function getCardExpYearArray()
	{
		$date = new Zend_Date();
		$year = $date->get(Zend_Date::YEAR);
		

		$num = 10;
		$arr[] = 'Select a year';
		for( $i = 0; $i < $num; $i++ )
		{
			$arr[$year+$i] = $year+$i;
		}
		return $arr;
		
	}
	protected $_cardExpMonthArray = array ('' => 'Select a month',
											'01' => '01',
											'02' => '02',
											'03' => '03',
											'04' => '04',
											'05' => '05',
											'06' => '06',
											'07' => '07',
											'08' => '08',
											'09' => '09',
											'10' => '10',
											'11' => '11',
											'12' => '12'
											);
	
	protected $_usStatesArray = array('' =>"Select a state",
											'AL'=>"Alabama",
							                'AK'=>"Alaska",  
							                'AZ'=>"Arizona",  
							                'AR'=>"Arkansas",  
							                'CA'=>"California",  
							                'CO'=>"Colorado",  
							                'CT'=>"Connecticut",  
							                'DE'=>"Delaware",  
							                'DC'=>"District Of Columbia",  
							                'FL'=>"Florida",  
							                'GA'=>"Georgia",  
							                'HI'=>"Hawaii",  
							                'ID'=>"Idaho",  
							                'IL'=>"Illinois",  
							                'IN'=>"Indiana",  
							                'IA'=>"Iowa",  
							                'KS'=>"Kansas",  
							                'KY'=>"Kentucky",  
							                'LA'=>"Louisiana",  
							                'ME'=>"Maine",  
							                'MD'=>"Maryland",  
							                'MA'=>"Massachusetts",  
							                'MI'=>"Michigan",  
							                'MN'=>"Minnesota",  
							                'MS'=>"Mississippi",  
							                'MO'=>"Missouri",  
							                'MT'=>"Montana",
							                'NE'=>"Nebraska",
							                'NV'=>"Nevada",
							                'NH'=>"New Hampshire",
							                'NJ'=>"New Jersey",
							                'NM'=>"New Mexico",
							                'NY'=>"New York",
							                'NC'=>"North Carolina",
							                'ND'=>"North Dakota",
							                'OH'=>"Ohio",  
							                'OK'=>"Oklahoma",  
							                'OR'=>"Oregon",  
							                'PA'=>"Pennsylvania",  
							                'PR'=>"Puerto Rico",  
							                'RI'=>"Rhode Island",  
							                'SC'=>"South Carolina",  
							                'SD'=>"South Dakota",
							                'TN'=>"Tennessee",  
							                'TX'=>"Texas",  
							                'UT'=>"Utah",  
							                'VT'=>"Vermont",  
							                'VA'=>"Virginia",  
							                'WA'=>"Washington",  
							                'WV'=>"West Virginia",  
							                'WI'=>"Wisconsin",  
							                'WY'=>"Wyoming");
	
	
}


?>