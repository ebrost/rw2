<?php

class Ficheactivite extends AnnuaireAppModel{
  
    public $name='Ficheactivite';
	public $findMethods = array(
'all' => true, 'first' => true, 'count' => true,
'neighbors' => true, 'list' => true, 'threaded' => true,'byCriteria' => true);
    public $displayField = 'nom_complet';
  //  public $belongsTo ='Operateur';
    public $hasAndBelongsToMany=array(
      	  'Genre'=>array(
            'className'=>'Annuaire.Genre',
            'with'=>'Annuaire.ficheactivites_genres'
        ),
        'Discipline'=>array(
            'className'=>'Annuaire.Discipline',
            'with'=>'Annuaire.ficheactivites_disciplines'
        ),
        'Activite'=>array(
            'className'=>'Annuaire.Activite',
            'with'=>'Annuaire.ficheactivites_activites'
        ),
	/*
        'Commune'=>array(
            'className'=>'Commune',
            'with'=>'Annuaire.ficheactivites_communes'
        ),
        'Pays'=>array(
            'className'=>'Pays',
            'with'=>'Annuaire.ficheactivites_pays'
        ),
        'BassinPopulation'=>array(
            'className'=>'BassinPopulation',
            'with'=>'Annuaire.ficheactivites_bassin_populations'
        ),
        'CommunauteCommune'=>array(
            'className'=>'CommunauteCommune',
            'with'=>'Annuaire.ficheactivites_communaute_communes'
        )
        */
    );
    
    
    public $hasMany=array(
        'Media'=>array(
            'className'=>'Annuaire.Media',
        ),
		/*
        'Contact'=>array(
            'className'=>'Annuaire.Contact',
        )
		*/
    );
	
	
	public function getActivitiesList(){
		$activityLevelsDisplay=intval(2*$this->getActivityLevelsDisplay());
		$activityRoot =$this->getActivityRoot();
		$activityRestriction=null;
		
		if(!empty($activityRoot)){
			$activityRestriction['Activite.id LIKE']=$activityRoot.'%';
		}
		
		if($activityLevelsDisplay>0){
			$activityRestriction['LENGTH(Activite.id) <=']=$activityLevelsDisplay;
		}
		$results = $this->Activite->find('list',array('conditions'=>$activityRestriction));
		return $results;
	}
	
	
    public function _getConditions($data,$encoded=true){
	//debug($data);
	   if(!empty($data)){
			$dataArray=$data;
			if($encoded){
				$dataArray=unserialize(base64_decode($data));
			}
		}
		else{
			//return null;
		}
		//debug($dataArray);
		//new array
		$searchConditions=array();
		//recherche sur mots clés
		
		
		if(!empty($dataArray['Search']['keywords'])) {
		$searchConditions['additionalsFields']=array();
		$searchConditions['orderBy']=array();
		$keywords = explode(" ",trim($dataArray['Search']['keywords']));
		$pluralKeywords = $keywords;
		$pluralKeywords = array_map(create_function('$val', ' return $val.="s";'),$pluralKeywords);
		$keywords =implode(",",array_merge($keywords,$pluralKeywords));
		//$this->virtualFields['relnomcomplet']="MATCH(Ficheactivite.nom_complet) AGAINST('".$dataArray['Search']['keywords']."')";
		//$this->virtualFields['relcommentaires']="MATCH(Ficheactivite.commentaires,Ficheactivite.commentaires_arts_visuels,Ficheactivite.commentaires_audio_visuel,Ficheactivite.commentaires_livre,Ficheactivite.commentaires_patrimoine,Ficheactivite.commentaires_spectacle) AGAINST('".$dataArray['Search']['keywords']."')";
		$this->virtualFields['relevance']="MATCH(Ficheactivite.nom_complet,Ficheactivite.commentaires,Ficheactivite.commentaires_arts_visuels,Ficheactivite.commentaires_audio_visuel,Ficheactivite.commentaires_livre,Ficheactivite.commentaires_patrimoine,Ficheactivite.commentaires_spectacle) AGAINST('".$keywords."')";
				
		$searchConditions['additionalsFields']=array("MATCH(Ficheactivite.nom_complet,Ficheactivite.commentaires,Ficheactivite.commentaires_arts_visuels,Ficheactivite.commentaires_audio_visuel,Ficheactivite.commentaires_livre,Ficheactivite.commentaires_patrimoine,Ficheactivite.commentaires_spectacle) AGAINST('".$keywords."') as Ficheactivite__relevance",
																		)
														;
			$searchConditions['conditions'][] =$searchConditions['keywordsConditions']= "MATCH(Ficheactivite.nom_complet,Ficheactivite.commentaires,Ficheactivite.commentaires_arts_visuels,Ficheactivite.commentaires_audio_visuel,Ficheactivite.commentaires_livre,Ficheactivite.commentaires_patrimoine,Ficheactivite.commentaires_spectacle) AGAINST ('".$keywords."')";
			$searchConditions['orderBy']=array('Ficheactivite.relevance'=>'desc');
		}
		
		// recherche sur nom
		if(!empty($dataArray['Search']['name'])) {
			$searchConditions['conditions']['Ficheactivite.nom_complet LIKE'] = '%'.$dataArray['Search']['name'].'%';
		}
		
		//recherche sur activite
		if(!empty($dataArray['Search']['activite'])) {
			$this->bindModel(array(
					'hasOne' => array(
						'FicheactivitesActivite' => array(
							'className' => 'Annuaire.FicheactivitesActivites',
							'foreign_key' => 'activite_id',
							
						),
					),
				),false);
			$condition="FicheactivitesActivite.activite_id LIKE ";
			$connect="";
								
			if(is_array($dataArray['Search']['activite'])){
				foreach ($dataArray['Search']['activite'] as $key=>$value){
					if (!empty($value)){
						$condition.=$connect."'".$value.'%'."'";
						$connect=" OR FicheactivitesActivite.activite_id LIKE ";
						//$this->data['Search']['activite'] = $dataArray['Search']['activite'];
					}
				}
			}
			else{
				$condition.="'".$dataArray['Search']['activite'].'%'."'";
			}									
			$searchConditions['conditions'][]="(".$condition.")";
		

		//contrainte sur activite
		$activityRoot=$this->getActivityRoot();
			if(!empty($activityRoot)){
				$this->bindModel(array(
					'hasOne' => array(
						'FicheactivitesActivite' => array(
							'className' => 'Annuaire.FicheactivitesActivites',
							'foreign_key' => 'activite_id',
						),
					),
				),false);
								
			$searchConditions['conditions'][]="FicheactivitesActivite.activite_id LIKE "."'".$activityRoot.'%'."'";
		}
		
		
										
		}
		//recherche sur genre
		if(!empty($dataArray['Search']['genre'])) {
			$this->bindModel(array(
				'hasOne' => array(
					'FicheactivitesGenre' => array(
						'className' => 'Annuaire.FicheactivitesGenres',
						'foreign_key' => 'genre_id',
					),
				),
			),false);
			
			$condition="FicheactivitesGenre.genre_id LIKE ";
			$connect="";
								
			if(is_array($dataArray['Search']['genre'])){
				foreach ($dataArray['Search']['genre'] as $key=>$value){
					if (!empty($value)){
						$condition.=$connect."'".$value.'%'."'";
						$connect=" OR FicheactivitesGenre.genre_id LIKE ";
					}
				}
			}
			else{
				$condition.="'".$dataArray['Search']['genre'].'%'."'";
			}								
			$searchConditions['conditions'][]="(".$condition.")";
			
		}
		
		//recherche sur discipline
		if(!empty($dataArray['Search']['discipline'])) {
			$this->bindModel(array(
				'hasOne' => array(
					'FicheactivitesDiscipline' => array(
						'className' => 'Annuaire.FicheactivitesDisciplines',
						'foreign_key' => 'discipline_id',
					),
				),
			),false);
			$condition="FicheactiviteDiscipline.discipline_id LIKE ";
			$connect="";
								
			if(is_array($dataArray['Search']['discipline'])){
				foreach ($dataArray['Search']['discipline'] as $key=>$value){
					if (!empty($value)){
						$condition.=$connect."'".$value.'%'."'";
						$connect=" OR FicheactiviteDiscipline.discipline_id LIKE ";
					}
				}
			}
			else{
				$condition.="'".$dataArray['Search']['discipline'].'%'."'";
			}								
			$searchConditions['conditions'][]="(".$condition.")";
			//$this->data['Search']['discipline'] = $dataArray['Search']['discipline'];
		}
		//recherche sur commune
		debug($dataArray);
		
		if(!empty($dataArray['Search']['commune']) && !empty($dataArray['Search']['commune_id'])) {
			$this->bindModel(array(
				'hasOne' => array(
					'FicheactivitesCommune' => array(
						'className' => 'Annuaire.FicheactivitesCommunes',
						'foreign_key' => 'commune_id',
					),
				),
			),false);
			$communes_list=$dataArray['Search']['commune_id'];
			$communes_list=explode(',',$communes_list);
			if((int)$dataArray['Search']['radius']){
				$addtionalCommunes=$this->query('CALL communes_near2("'.$dataArray['Search']['commune'].'",'.$dataArray['Search']['radius'].')');
				
				if(!empty($addtionalCommunes[0][0]['communes_list'])) {
					$addtionalCommunes='"'.str_replace(',','","',$addtionalCommunes[0][0]['communes_list']).'"';
				
					$addtionalCommunes=explode(',',$addtionalCommunes);
					debug(count($addtionalCommunes));
					//$communes_list=rtrim($addtionalCommunes[0][0]['communes_list'],'"').$communes_list;
					$communes_list=array_merge($communes_list,$addtionalCommunes);
				}
				
				
				debug(count($communes_list));
			}
			
			$condition="FicheactivitesCommune.commune_id IN (".implode(',',$communes_list).")";
		//	$condition.="'".$dataArray['Search']['commune'].'%'."'";
																
			$searchConditions['conditions'][]="(".$condition.")";
		}
		
		//recherche sur contact
		
		if(!empty($dataArray['Search']['contact'])) {
			$this->bindModel(array(
				'hasOne' => array(
					'Contact' => array(
						'className' => 'Annuaire.Contact',
						'foreign_key' => 'ficheactivite_id',
						),
				),
			),false);
			$searchConditions['conditions'][] = "Contact.name LIKE '".$dataArray['Search']['contact']."%'";
			
				}
				
		//recherche sur implantation
		if(!empty($dataArray['Search']['implantation'])) {
			$this->bindModel(array(
				'hasOne' => array(
					'FicheactivitesCommune' => array(
						'className' => 'Annuaire.FicheactivitesCommune',
						'foreign_key' => 'commune_id',
					),
				),
			),false);
			$condition="FicheactivitesCommune.commune_id LIKE ";
			$connect="";
			if(is_array($dataArray['Search']['implantation'])){
				foreach ($dataArray['Search']['implantation'] as $key=>$value){
					if (!empty($value)){
						$condition.=$connect."'".$value.'%'."'";
						$connect=" OR FicheactivitesCommune.commune_id LIKE ";
					}
				}
			}
			else{
				 $condition.="'".$dataArray['Search']['implantation'].'%'."'";
			}								
			$searchConditions['conditions'][]="(".$condition.")";
		}
		
		//recherche sur communauté de communes
		
		if(!empty($dataArray['Search']['communaute_communes'])) {
			$this->bindModel(array(
				'hasOne' => array(
					'FicheactivitesCommunauteCommune' => array(
						'className' => 'Annuaire.FicheactivitesCommunauteCommune',
						'foreign_key' => 'communaute_commune_id',
					),
				),
			),false);
			$searchConditions['conditions'][] = "FicheactivitesCommunauteCommune.communaute_commune_id LIKE'".$dataArray['Search']['communaute_communes']."%'";
		}
		
		//recherche sur pays
		
		if(!empty($dataArray['Search']['pays'])) {
			$this->bindModel(array(
				'hasOne' => array(
					'FicheactivitesPays' => array(
						'className' => 'Annuaire.FicheactivitesPays',
						'foreign_key' => 'pays_id',
					),
				),
			),false);
			$searchConditions['conditions'][] = "FicheactivitesPays.pays_id LIKE '".$dataArray['Search']['pays']."%'";
		}
		
		//recherche sur bassin de population
		
		if(!empty($dataArray['Search']['bassin_population'])) {
			$this->bindModel(array(
				'hasOne' => array(
					'FicheactivitesBassinPopulations' => array(
						'className' => 'Annuaire.FicheactivitesBassinPopulations',
						'foreign_key' => 'bassin_population_id',
					),
				),
			),false);
			$searchConditions['conditions'][] ="FicheactivitesBassinPopulations.bassin_population_id LIKE '".$dataArray['Search']['bassin_population']."%'";
		}
				
				
	  
		return $searchConditions;
	}

	public function _getList($idList=null){
	if(isset($idList)){
	$this->unbindModel(
			array(
				'hasAndBelongsToMany'=>array('Activite','Genre','Discipline'),
				'hasMany'=>array('Media'),
				)
			);
	$results=$this->find('all', array('conditions' => array('Ficheactivite.id' => $idList),'order'=>array('FIND_IN_SET(Ficheactivite.id,\''.implode(',',$idList).'\')')));	
	return $results;
	}
  }

	protected function _findByCriteria($state, $query, $results = array()) {
	/*
		$this->unbindModel(
			array(
				'hasAndBelongsToMany'=>array('Activite','Genre','Discipline'),
				//'hasMany'=>array('Media'),
				)
		);
		*/
        if ($state == 'before') {
			 if (!empty($query['operation']) && $query['operation'] == 'count') {
						$query['fields']=array('COUNT(DISTINCT Ficheactivite.id) as count');
				}
			$activityRoot=$this->getActivityRoot();
			if (!empty($activityRoot)){
				
				$this->bindModel(array(
					'hasOne' => array(
						'FicheactivitesActivite' => array(
							'className' => 'Annuaire.FicheactivitesActivites',
							'foreign_key' => 'activite_id',	
						),
					),
				),false);
				
				$query['conditions'][]= " (FicheactivitesActivite.activite_id LIKE '".$activityRoot."%')";
			}
			//debug($query);
            return $query;
        }
        return $results;
    }
     
	public function _findById($id){
		$result=Cache::read('ficheactivite_'.$id,'annuaire');
		if (!$result){
			
			Cache::write('ficheactivite_'.$id, $result,'annuaire');
		}
		$result=$this->find('first',array('conditions'=>array('Ficheactivite.id'=>$id)));
		return $result;
	}
	
	public function prevAndNext($id,$name,$q,$r=0){
		$searchConditions=$this->_getConditions($q);
		$searchConditions['conditions']=(!empty($searchConditions['conditions']))? $searchConditions['conditions']: array(null);
		//filtrage difficile : pas de double..
		//$r= (float)$r;
		//debug($r);
		$prevAndNext=array();
		
		if(isset($r) && $r>0){
			$this->virtualFields['relevance']=$searchConditions['additionalsFields'];
				
			$prevAndNext['prev']= $this->find('first',
						array(
							'order'=>array('Ficheactivite__relevance asc','Ficheactivite.nom_complet asc','Ficheactivite.id asc'),
							'fields'=>array_merge(array('DISTINCT Ficheactivite.id','Ficheactivite.nom_complet'),$searchConditions['additionalsFields']),
							'conditions'=>array_merge($searchConditions['conditions'],array($searchConditions['keywordsConditions'].'>'.$r)),
							'recursive'=>0
						)
					);
			$prevAndNext['next']= $this->find('first',
						array(
							'order'=>array('Ficheactivite__relevance desc','Ficheactivite.nom_complet asc','Ficheactivite.id asc'),
							'fields'=>array_merge(array('DISTINCT Ficheactivite.id','Ficheactivite.nom_complet'),$searchConditions['additionalsFields']),
							'conditions'=>array_merge($searchConditions['conditions'],array($searchConditions['keywordsConditions'].'<'.$r)),
							'recursive'=>0
							)
							
					);
					/*
					$this->virtualFields['relevance']="MATCH(Ficheactivite.nom_complet,Ficheactivite.commentaires,Ficheactivite.commentaires_arts_visuels,Ficheactivite.commentaires_audio_visuel,Ficheactivite.commentaires_livre,Ficheactivite.commentaires_patrimoine,Ficheactivite.commentaires_spectacle) AGAINST('".$dataArray['Search']['keywords']."')";
				
		$searchConditions['additionalsFields']=array("MATCH(Ficheactivite.nom_complet,Ficheactivite.commentaires,Ficheactivite.commentaires_arts_visuels,Ficheactivite.commentaires_audio_visuel,Ficheactivite.commentaires_livre,Ficheactivite.commentaires_patrimoine,Ficheactivite.commentaires_spectacle) AGAINST('".$dataArray['Search']['keywords']."') as Ficheactivite__relevance",
																		)
														;
			$searchConditions['conditions'][] = "MATCH(Ficheactivite.nom_complet,Ficheactivite.commentaires,Ficheactivite.commentaires_arts_visuels,Ficheactivite.commentaires_audio_visuel,Ficheactivite.commentaires_livre,Ficheactivite.commentaires_patrimoine,Ficheactivite.commentaires_spectacle) AGAINST ('".$dataArray['Search']['keywords']."')";
			$searchConditions['orderBy']=array('Ficheactivite.relevance'=>'desc');
					*/
		}
		else{
			$prevAndNext['prev']= $this->find('first',
						array(
							'order'=>array('Ficheactivite.nom_complet asc','Ficheactivite.id asc'),
							'fields'=>'DISTINCT Ficheactivite.id,Ficheactivite.nom_complet',
							'conditions'=>array_merge($searchConditions['conditions'],array('Ficheactivite.nom_complet'=> $name,'Ficheactivite.id <'=>$id)),
							'recursive'=>0
							)
							
					);
			if (empty($prevAndNext['prev'])){
				$prevAndNext['prev']=$this->find('first',
						array(
							'order'=>array('Ficheactivite.nom_complet desc,Ficheactivite.id desc'),
							'fields'=>'DISTINCT Ficheactivite.id,Ficheactivite.nom_complet',
							'conditions'=>array_merge($searchConditions['conditions'],array('Ficheactivite.nom_complet <'=> $name)),
							'recursive'=>0
							)
					);
				
			}
			
		
		
			$prevAndNext['next']= $this->find('first',
						array(
							'order'=>array('Ficheactivite.nom_complet asc,Ficheactivite.id asc'),
							'fields'=>'DISTINCT Ficheactivite.id,Ficheactivite.nom_complet',
							'conditions'=>array_merge($searchConditions['conditions'],array('Ficheactivite.nom_complet'=> $name,'Ficheactivite.id >'=>$id)),
							'recursive'=>0
							)
					);
			if (empty($prevAndNext['next'])){
				$prevAndNext['next']=$this->find('first',
						array(
							'order'=>array('Ficheactivite.nom_complet asc,Ficheactivite.id asc'),
							'fields'=>'DISTINCT Ficheactivite.id,Ficheactivite.nom_complet',
							'conditions'=>array_merge($searchConditions['conditions'],array('Ficheactivite.nom_complet >'=> $name)),
							'recursive'=>0
							)
					);
				
			}
		}
		//debug(array_merge($this->_getConditions($q),array('Ficheactivite.nom_complet >'=> $name)));
		return $prevAndNext;
	
	}
	 
	public function afterFind($results) {
		if(!empty($results)){
			foreach($results as $keyResult=>$valueResult){
				$results[$keyResult][$this->alias]['num'] = $keyResult;
				if (!empty($valueResult['Media'])){
					foreach ($valueResult['Media'] as $media){
						if ($media['affichage_liste']==1){
							$results[$keyResult][$this->alias]['thumbnail']=$media['file'];
							break;
						}
					}
				}
			}
		}
		return $results;
	}
	 
   
      
}