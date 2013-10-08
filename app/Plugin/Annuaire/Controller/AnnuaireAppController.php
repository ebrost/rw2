<?php
App::uses('AppController', 'Controller');
class AnnuaireAppController extends AppController{

	protected $appName='Annuaire';

  public function __construct( $request = NULL, $response = NULL )	{
	$annuaireAppName = (array)Configure::read('Annuaire.appName');
  
		if (!empty($annuaireAppName)) {
			$this->appName= $annuaireAppName[0];
		}
		
		$this->set('title_for_layout',$this->appName);
	parent::__construct( $request, $response );
  }
  
  public function beforeRender(){
  
    parent::beforeRender();
  }

}

