
	var Ric= window.Ric ||{};
	
	
	
	Ric.addToFavorite =function(key){
	
	this.key=key;
	this.items=[];
	
		//var key;
	
	function setKey(key){
			this.key=key;
	}
	
	
	function setEmptyLabel(emptyLabel){
			this.emptyLabel=emptyLabel;
		}
		
	function init(){
			
			setElements();
			renderItemsFromStore();
			bindEvents();
			//this.render();
			//console.log(key);
		}
	function setElements(){
			this.items=getItemsList()|| [];
			this.itemsCount=this.items.length;
			this.shortListCount =$("#favorite-itemsListCount");
			this.itemsList = $("#favorite-itemsList");
			this.clearAll = $("#favorite-clear-all");
			this.emaillink=$('#favorite-email');
			this.emailIDList=$($('#favorite-email').attr('href') +' input[name="data[Email][idList]"]'); //=>modal id
			this.pdflink=$('#favorite-pdf');
			this.basepdflinkhref=this.pdflink.attr('href');	
		}
		/*
		function getItems (){
		}
		*/
		
		
		function getItems(){
			return this.items
		}
		function updateLinks(){
			var itemsList=getItemsList();
				setPdfLink(itemsList);
				setEmailLink(itemsList)
		
		}
		
		function setEmailLink(itemsList){
			//console.log(this.emaillinkhref)
			emailIDList.val(itemsList);
		}
		function setPdfLink (itemsList){

			
			var href=(itemsList) ? this.basepdflinkhref+'/idList:'+itemsList : this.basepdflinkhref;
			this.pdflink.attr('href',href);	
			//this.pdflink.css('color','red');
		}
		
		function updateCount(){
		var count= this.itemsList.find('li').length;
		//console.log(count);
			if(count>0){
				this.shortListCount.text(count);
				$('.empty').hide();
				$('.not-empty').show();
			}
			else{
				this.shortListCount.empty();
				$('.empty').show();
				$('.not-empty').hide();
			}
		}
		
		function renderItemsFromStore(){
			//updatepdflink
			updateLinks();
			//build list
			for(i=0;i<this.items.length;i++){
				//this.itemsList.append("<li id='"+this.key+"-"+this.items[i]+"' data-listitem="+this.items[i]+">"+"<span class='editable'>"+localStorage.getItem(this.key+"-"+this.items[i])+"</span> <button class='remove'><i class='icon-trash'></i></button></li>");
				renderItem({id:this.items[i]});
			}
			updateCount();
		}
		
		function bindEvents(){
		//var that=this;
		
			//add item
			$(".add-to-list-js").click(function(e){
				e.preventDefault();
				
					$(this).addClass('addedToShortList');
					addItem({content:$(this).attr("data-content-shortlist"),id:$(this).attr("data-id-shortlist")});
				
			//	console.log(e);
				//calculateShortListCount())
			});
			
			
			//remove item
			this.itemsList.on("click",".remove",function(e){
				e.preventDefault();
				removeItem($(this).parent());
			});
			
			this.itemsList.on("mouseover mouseout","li",function(e){
			var b=$(this).find("button");
			e.type==="mouseover"?b.stop(true,true).fadeIn():b.stop(true,true).fadeOut()
			
			})
			
			this.itemsList.sortable({
			revert:50,
			stop:setItemsList
			})
			
			
		}
		
		function renderItem(data){
		var itemId= key+"-"+data.id;
		this.itemsList.append("<li id='"+itemId+"' data-listitem="+data.id+">"+"<span class='editable'>"+localStorage.getItem(key+"-"+data.id)+" </span><button class='remove'><i class='icon-trash'></i></button></li>");		
		$("#"+itemId).css("display","none").fadeIn();
		$('.add-to-list-js[data-id-shortlist="'+data.id+'"]').addClass('addedToShortList');
		}
		
		
		function addItem(data){
		//console.log(data.id);
		//console.log(this.items);
			if($("#favorite-itemsList").find("#"+key+"-"+data.id).length==0){
				console.log("item NOT found..adding new item");
				
				localStorage.setItem(key+"-"+data.id,data.content);
				renderItem(data);
				setItemsList();
			}
		}
		
		function removeItem(item){
			var itemId=item.attr('data-listitem');
			localStorage.removeItem(key+"-"+itemId);
			item.fadeOut(function(){
				this.remove();
				$('.add-to-list-js[data-id-shortlist="'+itemId+'"]').removeClass('addedToShortList');
				setItemsList();
			})
			
		}
		
		
		function removeAllItem(){
		
		}
		
		function setItemsList(){
			var  items = $("#favorite-itemsList").find('li'),listItemsforStorage=[];
			
			items.each(function(){
				listItemsforStorage.push($(this).attr("data-listitem"));
			});
			localStorage.setItem(key+"-list",JSON.stringify(listItemsforStorage));
			updateCount();
			updateLinks();
			/*
			pdflink.attr('href', function () {
							return  pdflinkhref+'/idList:'+h.join(",") ;
					});
			*/
		}
		
		function getItemsList(){
		return JSON.parse(localStorage.getItem(key+"-list")) 
		}
		
	init();
};


