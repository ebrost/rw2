<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Sanitize','Utility');

class EmailController extends AppController{

private $model;

public function beforeFilter(){
    if ($this->request->accepts('application/json')) {
        $this->RequestHandler->renderAs($this, 'json');
    }
	
	$this->model=ClassRegistry::init(array('class'=>'Email','table'=>false,'type'=>'Model'));
	
		$this->model->validate=array(
			
			'emailTo'=>array(
				'notEmpty'=>array(
					'rule'=>'notEmpty',
					'message'=>'Champ Obligatoire'
				),
				'email'=>array(
					'rule'=>'email',
					'message'=>'Email non valide'
				)
			),
			'emailFrom'=>array(
				'notEmpty'=>array(
					'rule'=>'notEmpty',
					'message'=>'Champ Obligatoire'
				),
				'email'=>array(
					'rule'=>'email',
					'message'=>'Email non valide'
				)
			)

		);
	$this->model->set($this->request->data);
    parent::beforeFilter();
}

public function checkValidation(){

	//$fieldName=$this->request->data['Email'];
	$fieldNameArray=array_keys($this->request->data['Email']);
	//debug($fieldNameArray);
	if($this->model->validates(array('fieldList'=>$fieldNameArray))){
		$this->set('reponse',true);
		$this->set('_serialize',array('reponse'));
	}
	else{
		$errors=$this->model->validationErrors;
		$this->set('model',$this->model->alias);
		$this->set('errors',$errors);
		$this->set('_serialize',array('model','errors'));
	}
		
}

 public function sendToFriend(){
	
		
		if ($this->model->validates()){
			
			$plugin=Inflector::camelize($this->request->data['Email']['plugin']);
			$controller=$this->request->data['Email']['controller'];
			$model=Inflector::classify($controller);
			
			$Email= new CakeEmail();
			$Email->helpers('Html');
			$Email->config(Configure::read('Email'));
			$pluginConf=Configure::read($plugin);
			
			
			$emailSubject=(!empty($pluginConf['emailSubject']))?$pluginConf['emailSubject']:$Email->emailSubject;	
			$Email->template($plugin.'.sendToFriend',$plugin.'.default');
			$Email->to($this->request->data['Email']['emailTo']);
			$Email->from($this->request->data['Email']['emailFrom']);
			$Email->subject($emailSubject);
			$Email->sender($Email->username,$pluginConf['appName']);
			
			
			$idList=$idList=explode(',',$this->request->data['Email']['idList']);
			
			$className=$plugin.'.'.$model;
			
			$linkedModel= ClassRegistry::init(array('class'=>$className,'type'=>'Model'));
			
			$results=$linkedModel->_getList($idList);
			$links=array();
			if (count($results)>1){
				foreach($results as $result){
					$links[]=array(
						'url'=>Router::url('/',true).$plugin.'/'.$controller.'/'.$result[$model]['id'].'-'.Inflector::slug($result[$model]['nom_complet']),
						'nom'=>$result[$model]['nom_complet']
					);
				}
			
			}
			else{
				$links[]=array(
				'url'=>Router::url('/',true).$plugin.'/'.$controller.'/'.$results[0][$model]['id'].'-'.Inflector::slug($results[0][$model]['nom_complet']),
				'nom'=>$results[0][$model]['nom_complet'],
				);
			}
			
			
			$Email->viewVars(array(
			'message'=>Sanitize::html($this->request->data['Email']['message']),
			'from'=>$this->request->data['Email']['emailFrom'],
			'links'=>$links,
			
			));
			//$Email->message("mail envoyé");
			if($Email->send()){
			$reponse='votre message a été envoyé';
			}
			else{
			$reponse='un probleme est survenu.<br>
			Veuillez rééssayer ultérieurement.<br>
			Si le probleme persiste, contactez l\'administrateur du site ';
			}
			//envoi du mail
			
			$this->set('reponse',$reponse);
			$this->set('_serialize',array('reponse'));
			
			//données
			$this->set('commentaire',$reponse);
			
		}
		else{
		
			$errors=$this->model->validationErrors;
			$this->set('model',$this->model->alias);
			$this->set('errors',$errors);
			$this->set('_serialize',array('model','errors'));
		}
	
			
	
  }
}