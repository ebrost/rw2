<?php
class Discipline extends AnnuaireAppModel
{
	public $name='Discipline';
	/*
	public $hasAndBelongsToMany=array(
		
		'Genre'=>array(
							'className'=>'Annuaire.Genre',
							'joinTable'=>'activites_genres_disciplines',
							'foreignKey'=>'genre_id',
							'associationForeignKey'=>'discipline_id',
					)
		);
	*/
	public function findLinkedByActiviteIdAndGenreId($activiteId,$genreId){
	
		$this->bindModel(array(
				'hasOne' => array(
					'ActivitesGenresDiscipline' => array(
						'className' => 'Annuaire.ActivitesGenresDiscipline',
						'foreign_key' => 'discipline_id',
					),
				),
			),false);							
			$listDisciplines=$this->find('all',array('fields' => 'DISTINCT Discipline.id,Discipline.title','conditions'=>array('ActivitesGenresDiscipline.activite_id'=>$activiteId,'ActivitesGenresDiscipline.genre_id'=>$genreId)));
			
			$optionsDisciplines=array();
			$hierarchicalSpacer=$this->getHierarchicalSpacer();
			foreach ($listDisciplines as $key=>$value){
				$level= ceil(strlen($value['Discipline']['id'])/2)-1;
				$optionsDisciplines[]=array('value'=>$value['Discipline']['id'],'name'=>str_repeat($hierarchicalSpacer,$level).$value['Discipline']['title'],'class'=>"level_".strval($level));
			}
		return $optionsDisciplines;
	}

}
?>