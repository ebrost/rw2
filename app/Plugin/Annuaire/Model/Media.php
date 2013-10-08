<?php
class Media extends AnnuaireAppModel
{
	public $name='Media';
	public $useTable='medias';
	public $belongsTo='Annuaire.Ficheactivite';
	
}
?>