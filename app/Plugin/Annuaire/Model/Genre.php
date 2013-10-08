<?php
class Genre extends AnnuaireAppModel
{
	public $name='Genre';
	/*
	public $hasAndBelongsToMany=array(
		
		'Activite'=>array(
							'className'=>'Annuaire.Activite',
							'joinTable'=>'activites_genres_disciplines',
							'foreignKey'=>'activite_id',
							'associationForeignKey'=>'genre_id',
					)
		);
	*/
	public function findLinkedByActiviteId($activiteId){
	
		$this->bindModel(array(
				'hasOne' => array(
					'ActivitesGenresDiscipline' => array(
						'className' => 'Annuaire.ActivitesGenresDiscipline',
						'foreign_key' => 'genre_id',
					),
				),
			),false);							
			$listGenres=$this->find('all',array('fields' => 'DISTINCT Genre.id,Genre.title','conditions'=>array('ActivitesGenresDiscipline.activite_id'=>$activiteId)));
			//debug($listGenres);
			$optionsGenres=array();
			$hierarchicalSpacer=$this->getHierarchicalSpacer();
			foreach ($listGenres as $key=>$value){
				$level= ceil(strlen($value['Genre']['id'])/2)-1;
				$optionsGenres[]=array('value'=>$value['Genre']['id'],'name'=>str_repeat($hierarchicalSpacer,$level).$value['Genre']['title'],'class'=>"level_".strval($level));
			}
		return $optionsGenres;
	}
}
?>