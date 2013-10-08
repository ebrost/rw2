<?php

class AnnuaireAppModel extends AppModel{
  public $tablePrefix='annuaire_';
  
  
	protected $hiearchicalSpacer='';
	protected $activityRoot='';
	protected $activityLevelsDisplay=-1;
	protected $displayListOnLoad=true;
	protected $resultsPerPage = 10;
	protected $annuaire=null;

	public function getConfig(){
		if (empty($this->annuaire)) {
		$this->annuaire= Configure::read('Annuaire');
		}
		
	return $this->annuaire;
	}
	


	public function getHierarchicalSpacer(){
		if (array_key_exists('hiearchicalSpacer',$this->getConfig())) {
			$this->hiearchicalSpacer = $this->annuaire['hiearchicalSpacer'];
		}
		return $this->hiearchicalSpacer;
	}
	
	public function getActivityRoot(){
		if (array_key_exists('activityRoot',$this->getConfig())) {
			$this->activityRoot = $this->annuaire['activityRoot'];
		}
		return $this->activityRoot;
	}
	public function getActivityLevelsDisplay(){
		if (array_key_exists('activityLevelsDisplay',$this->getConfig())) {
			$this->activityLevelsDisplay = $this->annuaire['activityLevelsDisplay'];
		}
		return (int)$this->activityLevelsDisplay;
	}
	
	public function getDisplayListOnLoad(){
		if (array_key_exists('displayListOnLoad',$this->getConfig())) {
			$this->displayListOnLoad = $this->annuaire['displayListOnLoad'];
		}
		return $this->displayListOnLoad;
	}
	
	public function getResultsPerPage(){
		if (array_key_exists('resultsPerPage',$this->getConfig())) {
			$this->resultsPerPage = $this->annuaire['resultsPerPage'];
		}
		return $this->resultsPerPage;
	}
	
	
	
 
}