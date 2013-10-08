<?php

App::uses('AppController', 'Controller');


class UsersController extends AppController {
	public $name='Users';
	
	
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->deny('index');
	}
	
	public function index(){
	}
	public function login() {
			if ($this->request->is('post')) {
				if ($this->request->is('ajax')){
					$this->layout = 'ajax';
					// $this->render(false);
					if($this->checkValidation()){
						 if ($this->Auth->login()) {
							//return $this->redirect($this->Auth->redirectUrl());
							$this->set('redirectUrl',$this->Auth->redirectUrl());
							$this->set('_serialize',array('redirectUrl'));
						} else {
							//$this->Session->setFlash(__('Identifiant ou mot de passe incorrect'), 'default', array(), 'auth');
							$errors='Identifiant ou mot de passe incorrect';
							$this->set('errors',$errors);
							$this->set('_serialize',array('errors'));
						}
				
					}
					else{
						if ($this->Auth->login()) {
							return $this->redirect($this->Auth->redirectUrl());
						} else {
						 $this->Session->setFlash(__('Identifiant ou mot de passe incorrect'), 'default', array(), 'auth');
						}
					}
				}
			}
	}
	public function logout(){
	    $this->redirect($this->Auth->logout());
	}
	
	private function checkValidation(){

		return true;
	}
		


}