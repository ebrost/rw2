//utilise bootstrap tabs


var Ric= window.Ric ||{};

	Ric.viewTabs= function(id){
	var tabdisplay=false,index=null;
	$(id).children().css("display","none");
	$(id).children('li').each(function(i){
		var href=$(this).find('a').attr('href');
		 if ($.trim($(href).html())) {
			tabdisplay=true;
			if (!index) index=i;
			$(this).css("display","list-item").find('a').click(function(e){
				e.preventDefault();
				$(this).tab('show');
			})
		
		}
	});
	if(tabdisplay) $(id+" li:eq("+(index)+") a").tab('show');
  }