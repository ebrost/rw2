<?php
class Commune extends AppModel
{
	public $name='Commune';
	//public $hasAndBelongsToMany='Annuaire.ficheactivite';
	public $alias='Commune';
	
	//group_concat(DISTINCT cp ORDER BY cp )as
	
	function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->virtualFields['liste_cp'] = sprintf('GROUP_CONCAT(%s.cp ORDER BY cp SEPARATOR ",")', $this->name);
		$this->virtualFields['liste_id'] = sprintf('GROUP_CONCAT(CONCAT("\"",%s.id,"\"") ORDER BY cp SEPARATOR ",")', $this->name);
	}
}
?>