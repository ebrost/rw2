<?php
class Activite extends AnnuaireAppModel
{
	public $name='Activite';
	public $hasAndBelongsToMany=array(
	    'Ficheactivite'=>array(
	          'className'=>'Annuaire.Ficheactivite'
	     )
	);
}
?>