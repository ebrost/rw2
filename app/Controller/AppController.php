<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  public $helpers = array('Html','Form','Js','Session','PhpThumb.PhpThumb');
  public $components = array('DebugKit.Toolbar','RequestHandler','Session',
	  'Auth'=>array(
	  'authenticate' => array(
            'Form' => array(
                'passwordHasher' => array(
                    'className' => 'Simple',
                    'hashType' => 'sha1'
                )
            )
        ),
		'loginRedirect'=>array('controller','users','action'=>'index'),
		// a modifier
		'logoutRedirect'=>array('plugin'=>'annuaire','controller'=>'ficheactivites','action'=>'search'),
		'authError'=>"Vous n'avez pas accès à cette page",
		'authorize'=>array('Controller'),
		
	  )
  ); 
  
  public function beforeRender() {
    $this->response->disableCache();
    
}
  public function beforeFilter(){
	$this->Auth->allow();
  }
  public function isAuthorized($user){
	return true;
  }
  
 
  //public $components;
  //public $uses;
}
