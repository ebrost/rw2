<?php
class Contact extends AnnuaireAppModel
{
	public $name='Contact';
	public $belongsTo=array(
	        'Ficheactivite'=>array(
              'className'=>'Annuaire.Ficheactivite',
            )
	   );
	
}
?>