<?php


class CommunesController extends AppController{
  public $name='Communes';
  public $displayField ='nom';
  //public $components = array('RequestHandler');

  public function beforeFilter()
  {

    if($this->RequestHandler->isAjax())
    {
	
      Configure::write('debug', 0);
    }
    parent::beforeFilter();

  }


   public function autocomplete() {
     if($this->RequestHandler->isAjax())
     {
      //$this->layout = 'ajax';
        $communes=$this->Commune->find('all', array(
            'conditions' => array('Commune.nom LIKE' =>$this->params['url']['term'].'%','CHAR_LENGTH(id) >'=>4),
            'order' => 'Commune.nom',
            'fields' => array('Commune.nom','Commune.liste_id','Commune.liste_cp'),
			'group' => array('Commune.nom')
        //  'fields'=>array('DISTINCT nom')
        ));
		
        foreach ($communes as $commune){
				$lcp=(strlen($commune['Commune']['liste_cp'])<18) ? ($commune['Commune']['liste_cp']): (substr($commune['Commune']['liste_cp'],0,6).'...'.substr($commune['Commune']['liste_cp'],-6,6));
           $jsCommunes[]=array('label'=>$commune['Commune']['nom'],'id'=>$commune['Commune']['liste_id'],'cp'=>$lcp);
         //  $jsCommunes[]=array('value'=>$commune['Commune']['nom']);
         // $jsCommunes[]=$commune['Commune']['nom']);
        }

       $this->set('jsCommunes',$jsCommunes);
       $this->set('_serialize','jsCommunes');

  }
   }

}