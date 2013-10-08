<?php

App::uses('Sanitize', 'Utility');

class FicheactivitesController extends AnnuaireAppController {

    public $uses = array('Annuaire.Ficheactivite', 'Implantation', 'Pays', 'CommunauteCommune', 'BassinPopulation');
    public $actsAs = array('Containable');
    public $helpers = array('Cache', 'Html', 'Form', 'Tools.GoogleMapV3', 'Tools.PhpThumb');
    public $components = array('RequestHandler');
    public $cacheAction = array('view' => 36000);

    private function _formatList($list, $displayHierarchicalSpacer = true) {
        $hierarchicalSpacer = $this->Ficheactivite->getHierarchicalSpacer();
        $options = array();
        foreach ($list as $key => $value) {
            if ($displayHierarchicalSpacer) {
                $level = ceil(strlen($key) / 2);
            } else {
                $level = 0;
            }
            $options[] = array('value' => $key, 'name' => str_repeat($hierarchicalSpacer, $level) . $value, 'class' => "level_" . strval($level));
        }
        return $options;
    }

    public function beforeFilter() {
        $this->response->header('Access-Control-Allow-Origin', '*');
        parent::beforeFilter();
    }

    public function index() {
        $this->redirect('search');
    }

    public function display() {
        $this->redirect('search');
    }

    public function search() {
        //debug($this);

        $searchConditions = array();

        // on regarde la constante pour voir s'il faut afficher au chargement
        $displaySearchResults = $this->Ficheactivite->getdisplayListOnLoad();

        //si les donn�es proviennent d'un lien  
        if (!empty($this->request->params['named']['q'])) {
            $searchConditions = $this->Ficheactivite->_getConditions($this->request->params['named']['q']);
            $q = $this->request->params['named']['q'];
            $this->request->data = unserialize(base64_decode($q));
            $displaySearchResults = TRUE;
        }

        //si les donn�es viennent du formulaire,
        // on les serialize pour les passer aux liens (pagination, detail...)
        elseif (!empty($this->request['data']['Search']) && empty($this->request['params']['named']['q'])) {
            $searchConditions = $this->Ficheactivite->_getConditions($this->request['data'], false);
            $q = base64_encode(serialize($this->request['data']));
            $displaySearchResults = TRUE;
        }


        if ($displaySearchResults) {
            //$searchConditions
            $searchConditions['orderBy'] = (!empty($searchConditions['orderBy'])) ? $searchConditions['orderBy'] : array(null);
            $fields = (!empty($searchConditions['additionalsFields'])) ? array_merge(array('DISTINCT *'), $searchConditions['additionalsFields']) : 'DISTINCT *';
            $this->paginate = array(
                //'fields'=>'DISTINCT Ficheactivite.id',
                'fields' => $fields,
                'findType' => 'byCriteria',
                'limit' => 10,
                'order' => array_merge($searchConditions['orderBy'], array('nom_complet' => 'asc', 'id' => 'asc')),
                'conditions' => $searchConditions['conditions'],
                'group' => 'Ficheactivite.id'
                    //'fields'=>$fieldsList,
            );

            $fichesactivites = $this->paginate();

            while (list($key, $val) = each($fichesactivites)) {
                $idList[] = $val['Ficheactivite']['id'];
            }
            $idList = base64_encode(serialize(implode(',', $idList)));

            $this->set(compact('fichesactivites', 'submited', 'q', 'idList'));
            //	$this->set('_serialize', array('ficheactivites'));
        }



        //recuperation des listes pour les nomenclatures du requeteur.
        $listActivites = $this->Ficheactivite->getActivitiesList();
        $listImplantations = $this->Implantation->find('list');
        $listBassinPopulations = $this->BassinPopulation->find('list');
        $listPays = $this->Pays->find('list');
        $listCommunautesCommunes = $this->CommunauteCommune->find('list');

        //rendu des listes d'options
        $optionsActivites = $this->_formatList($listActivites, true);
        $optionsBassinPopulations = $this->_formatList($listBassinPopulations, false);
        $optionsImplantations = $this->_formatList($listImplantations, false);
        $optionsPays = $this->_formatList($listPays, false);
        $optionsCommunautesCommunes = $this->_formatList($listCommunautesCommunes, false);

        $this->set(compact('optionsActivites', 'optionsPays', 'optionsImplantations', 'optionsCommunautesCommunes', 'optionsBassinPopulations'));
        $this->render('index');
    }

    public function viewPdfList() {
        $this->RequestHandler->renderAs($this, 'pdf');
        if (isset($this->request->params['named']['idList'])) {
            $idList = $this->request->params['named']['idList'];
            if ($this->request->params['named']['encoded']) {
                $idList = explode(',', unserialize(base64_decode($idList)));
            } else {
                $idList = explode(',', $idList);
            }
            $fichesactivites = $this->Ficheactivite->_getList($idList);
            $this->set(compact('fichesactivites'));
        }
    }

    public function view($id = null, $slug = null) {
        //$this->cacheAction = true;
        //debug($this->request);
        //debug(unserialize(base64_decode($this->request->params['named']['q'])));

        if ($id) {
            //$ficheactivite=$this->Ficheactivite->find('first',array('conditions'=>array('Ficheactivite.id'=>$id)));
            $ficheactivite = $this->Ficheactivite->_findById($id);

            if (!empty($ficheactivite)) {
                $sluggedNomComplet = Inflector::slug($ficheactivite['Ficheactivite']['nom_complet']);
                if (strcmp($sluggedNomComplet, $slug) != 0) {
                    throw new NotFoundException('Pas de fiche activit� correspondante');
                }

                $this->set(compact('ficheactivite'));
                $this->set('_serialize', array('ficheactivite'));
            } else {
                throw new NotFoundException('Pas de fiche activit� correspondante');
            }
        }

        //debug($this->request);
    }

    public function viewNav($id = null, $nom = null) {
        if ($this->request->is('ajax')) {
            //Configure::write('debug', 0);
            //	if(!empty($this->request->params['named']['q'])){

            $prevAndNext = $this->Ficheactivite->prevAndNext($id, $nom, $this->request->params['named']['q'], $this->request->params['named']['r']);
            $prev = $prevAndNext['prev'];
            $next = $prevAndNext['next'];

            $page = isset($this->request->params['named']['page']) ? $this->request->params['named']['page'] : 1;
            if (isset($this->request->params['named']['num'])) {
                $ficheactivite['Ficheactivite']['num'] = $this->request->params['named']['num'];
                $next['Ficheactivite']['num'] = $this->request->params['named']['num'] + 1;
                $prev['Ficheactivite']['num'] = $this->request->params['named']['num'] - 1;
                $page = floor($ficheactivite['Ficheactivite']['num'] / $this->Ficheactivite->getResultsPerPage()) + $page;
            }
            //	debug($next);
            $this->set(compact('nom', 'prev', 'next', 'page'));
            $this->render('Elements/prevNextDetailBrowser', 'ajax');
            //	}
        }
    }

    public function getCount() {
        if ($this->request->is('ajax')) {

           // Configure::write('debug', 0);

            //clean data
            $cleanData = Sanitize::clean($this->request['data']);

            if (!empty($cleanData['Search']['commune_id'])) {
                $cleanData['Search']['commune_id'] = str_replace("&quot;", "'", $cleanData['Search']['commune_id']);
            }
            //debug($cleanData,false);
            $searchConditions = $this->Ficheactivite->_getConditions($cleanData, false);

            $count = $this->Ficheactivite->find('count', array(
                'conditions' => $searchConditions['conditions'],
                'fields' => 'COUNT(DISTINCT Ficheactivite.id) as count'
            ));

            $this->set(compact('count'));
            $this->set('_serialize', array('count'));
        } else {
            throw new BadRequestException('operation non autorisée');
        }
    }

}

?>