<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	static $registry;
	static $dbAdapter;
	
    protected function _initAutoload()
    {
    	$autoloader = Zend_Loader_Autoloader::getInstance();
    	$autoloader->registerNamespace('TopHealthSpot_')
					->registerNamespace('ZExt_')
					->registerNamespace('Sofzo_');
    	
    	$autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Default_',
            'basePath'  => dirname(__FILE__),
        ));
        return $autoloader;
    }

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
    }

    public function _initFrontController()
    {
		$frontController = Zend_Controller_Front::getInstance();
		$frontController->setControllerDirectory(
			array( 'default' => APPLICATION_PATH . '/modules/default/controllers',
			'admin' => APPLICATION_PATH . '/modules/admin/controllers'));

		$frontController->setParam('env', APPLICATION_ENV);
		$frontController->throwExceptions(true);   
		
		$categoryRoute = new Zend_Controller_Router_Route( 'category/:id/:title/*', array(
																	        'controller' => 'category',
																	        'action'     => 'view'));

		$subCategoryRoute = new Zend_Controller_Router_Route( 'sub-category/:id/:title/*', array(
																	        'controller' => 'sub-category',
																	        'action'     => 'view'));
		
		$couponRoute = new Zend_Controller_Router_Route( 'coupon/:id/:store/:coupon/*', array(
																	        'controller' => 'coupon',
																	        'action'     => 'view'));
		
		$contentRoute = new Zend_Controller_Router_Route( 'content/:id/:title/*', array(
																	        'controller' => 'content',
																	        'action'     => 'view'));
		
		$storeRoute = new Zend_Controller_Router_Route( 'store/:id/:title/*', array(
																	        'controller' => 'store',
																	        'action'     => 'view'));
		
		$frontController->getRouter()->addRoutes(array('category' =>$categoryRoute, 'subCategory'=>$subCategoryRoute, 'coupon'=>$couponRoute, 'content'=>$contentRoute, 'store'=>$storeRoute));
												
		return $frontController;
    }
    
    protected function _initSession()
    {
    	$this->bootstrap('frontController'); 	
    	$this->bootstrap('database'); 	
    	 	
    	Zend_Session::start(); 	
		$ns = new Zend_Session_Namespace('tophealth');
		$ns->setExpirationSeconds(300);
		
    	$frontendOptions = array(
    						'cache_id_prefix'=>'tophealth',
    						'automatic_serialization'=>true,
    						'caching'=>true
    	);
    	$backendOptions = array();
    	/*
		$cache = Zend_Cache::factory('Core', 'Zend_Cache_Backend_ZendServer_Disk',
                             $frontendOptions, $backendOptions, false, true);    	
		
    	Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);                             
		
		Zend_Registry::set('cache', $cache);			
		*/
		Zend_Registry::set('session', $ns);			
		
		
		Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('tophealth'));		
    	//Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);    	
    }
        
    protected function _initConfiguration()
    {
        $config = new Zend_Config_Ini(
            APPLICATION_PATH . '/../config/config.ini',
            APPLICATION_ENV
        );
        Zend_Registry::set('configuration', $config);      

		$locale = new Zend_Locale('en_US');
		Zend_Registry::set('Zend_Locale', $locale); 
		
		$frontendOptions = array(
		   'lifetime' => 7200,
		   'automatic_serialization' => true
		);
		$backendOptions = array('cache_dir' => APPLICATION_PATH . '/../../tmp-cache/');
		$cache = Zend_Cache::factory(
		    'Core', 'File', $frontendOptions, $backendOptions
		);
		
		Zend_Registry::set('cache', $cache);			
		
    }
    
    protected function _initDatabase()
    {
    	$this->bootstrap('configuration');
    	$config = Zend_Registry::get('configuration');
    	
        $dbAdapter = Zend_Db::factory( $config->database->adapter, $config->database );
        $dbAdapter->query("SET NAMES 'utf8'");
        
       	Zend_Registry::set('dbAdapter', $dbAdapter);
    	Zend_Db_Table::setDefaultAdapter($dbAdapter);    	
    }   
    
    protected function _initView()
    {
    	$this->bootstrap('session');
    	
    	$layout = Zend_Layout::startMvc(array('pluginClass' => 'TopHealthSpot_Layout_Controller_Layout'));
    	
		Zend_Controller_Action_HelperBroker::addPrefix('ZendX_JQuery_Controller_Action_Helper');
		Zend_Controller_Action_HelperBroker::addPrefix('PrintStore_Controller_Action_Helper');
		
		$layout->getView()->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
		$layout->getView()->addHelperPath('Sozfo/View/Helper/', 'Sozfo_View_Helper');
		$layout->getView()->addHelperPath('ZExt/View/Helper/', 'ZExt_View_Helper');
		$layout->getView()->addHelperPath('TopHealthSpot/View/Helper/', 'TopHealthSpot_View_Helper');
		
		$layout->getView()->setEncoding('UTF-8');
		$layout->getView()->jQuery()->enable();
		$layout->getView()->jQuery()->uiEnable();
	
		
		
		
		//$layout->getView()->placeholder('headTitle')->set(Zend_Registry::get('headTitle'));
		//$layout->getView()->placeholder('logoSrc')->set('/assets/logos/'.Zend_Registry::get('storeID').'.png');				
    }
}

?>