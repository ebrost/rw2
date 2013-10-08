<?php
class BassinPopulation extends AppModel
	{
	public $name='BassinPopulation';
	public $displayField='nom';
	public $hasAndBelongsToMany='Acteur';	
	}
?>