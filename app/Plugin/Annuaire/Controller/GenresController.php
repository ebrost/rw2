<?php

class GenresController extends AppController{
	public $name='Genres';
	//public $helpers = array('Ajax', 'Text');
	public $components = array('RequestHandler');

	public function beforeFilter()
	{
		parent::beforeFilter();
 
		if($this->RequestHandler->isAjax())
		{
			Configure::write('debug', 0);
		}
	}

	
	function getListByActiviteId($activiteId=null) {
	
		//$this->layout = 'ajax';
		//$activiteId = $this->params['form']['activiteId'];
		//debug($this->request);
		$activiteId=$this->request['data']['activiteId'];
	//	$hierarchicalSpacer= Configure::read('Form.HierarchicalSpacer');
		$hierarchicalSpacer=!empty($hierarchicalSpacer)? $hierarchicalSpacer:'.';
		if ($activiteId>0){
			$optionsGenres=$this->Genre->findLinkedByActiviteId($activiteId);
		
		}
	//$this->set(compact('optionsGenres','activiteId'));
	//$this->set('_serialize', array('optionsGenres','activiteId'));
	
	$this->set('optionsGenres',$optionsGenres);
	$this->set('_serialize','optionsGenres');
	}

}

?>