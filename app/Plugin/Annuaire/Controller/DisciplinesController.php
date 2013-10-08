<?php

class DisciplinesController extends AppController{
	public $name='Disciplines';
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

	
	function getListByActiviteIdAndGenreId($activiteId=null,$genreId=null) {
	
		//$this->layout = 'ajax';
		//$activiteId = $this->params['form']['activiteId'];
		//debug($this->request);
		$activiteId=$this->request['data']['activiteId'];
		$genreId=$this->request['data']['genreId'];
	//	$hierarchicalSpacer= Configure::read('Form.HierarchicalSpacer');
		$hierarchicalSpacer=!empty($hierarchicalSpacer)? $hierarchicalSpacer:'.';
		if ($activiteId>0 ){
			$optionsDisciplines=$this->Discipline->findLinkedByActiviteIdAndGenreId($activiteId,$genreId);
		
		}
		
	//$this->set(compact('optionsGenres','activiteId'));
	//$this->set('_serialize', array('optionsGenres','activiteId'));
	
	$this->set('optionsDisciplines',$optionsDisciplines);
	$this->set('_serialize','optionsDisciplines');
	}

}

?>