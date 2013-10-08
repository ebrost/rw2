$(function(){
    /* favorite*/
Ric.addToFavorite('ficheactivite');

/* search */
 searchConfig = {
        prefix: 'Annuaire',
        formElement: '#FicheactiviteSearchForm',
        formSubmitElement: '#searchFormSubmit',
        getCountUrl: jsBase + "/ficheactivites/getCount",
        getGenresByActiviteIdUrl:jsBase+"/Genres/getListByActiviteId",
        getDisciplinesListByActiviteIdAndGenreId:jsBase+"/Disciplines/getListByActiviteIdAndGenreId"

    };
    Ric.searchActionsManager(searchConfig);
})
