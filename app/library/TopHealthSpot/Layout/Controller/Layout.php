<?php
class TopHealthSpot_Layout_Controller_Layout extends Zend_Layout_Controller_Plugin_Layout
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{		
		switch( $request->getModuleName() )
		{
			case 'admin':
				$this->getLayout()->getView()->addScriptPath(APPLICATION_PATH . '/modules/admin/views/views/scripts' );
				$this->getLayout()->setLayoutPath(APPLICATION_PATH . '/modules/admin/views/layouts/scripts' );
				$this->getLayout()->setLayout('layout');
				break;
				
			default:
				$this->getLayout()->setLayoutPath(APPLICATION_PATH . '/modules/default/layouts/scripts' );
				$this->getLayout()->setLayout('layout');
				break;
		}
	}
}

            