//utilise bootstrap tabs

//$('video,audio').mediaelementplayer(/* Options */);

var Ric= window.Ric ||{};
	if (! Ric.carousel){
		Ric.carousel=function(data){
			var carouselContainer= data.carouselID,thumbscontainer=data.thumbsID;
			$(carouselContainer).carouFredSel({
					responsive: true,
					circular: false,
					auto: false,
					
					items: {
						visible: 1,
						width:200,
						height: '100%',
					},
					scroll: {
						fx: 'directscroll'
					}
				});

				$(thumbscontainer).carouFredSel({
					responsive: true,
					circular: false,
					infinite: false,
					auto: false,
					prev: '#prev',
					next: '#next',
					items: {
						visible: {
							min: 2,
							max: 3
						},
						width:35,
						height: '100%'
					}
				});

				$(thumbscontainer + ' a').click(function() {
					$(carouselContainer).trigger('slideTo', '#' + this.href.split('#').pop() );
					//console.log('#image' + this.href.split('#').pop());
					//$('#thumbs a').removeClass('selected');
					$(this).siblings().removeClass('selected');
					$(this).addClass('selected');
					return false;
				});
		}
	}
	if (! Ric.viewTabs) {
		Ric.viewTabs= function(id){
			var tabdisplay=false,index=-1;
			$(id).children().css("display","none");
			$(id).children('li').each(function(i){
				var href=$(this).find('a').attr('href');
				 if ($.trim($(href).html())) {
					tabdisplay=true;
					if (index<0) index=i;
					$(this).css("display","list-item").find('a').click(function(e){
						e.preventDefault();
						$(this).tab('show');
					})
				
				}
			});
			if(tabdisplay) $(id+" li:eq("+(index)+") a").tab('show');
		  }
  }
	
	if (! Ric.sendToFriendManager){
		Ric.sendToFriendManager=function(id){
		
		function showLoader(content){
			$(id+' .modal-bodyandfooter').hide();	
			$(document.createElement('div')).insertAfter($(id+ ' .modal-bodyandfooter')).addClass('loading modal-response modal-body').html(content);
		};

		function removeLoader(){
			$(id+' .loading').remove();
			$(id+' .modal-bodyandfooter').show();	
			
		};
		
		function cleanForm(){
			 $(id+' .help-inline').remove();
			$(id+' .error').each(function() {
				$(this).removeClass("error");
			});
		};

		function validate(){
			var form= $(id+' form');
			var deferred = $.Deferred();
			var promise = deferred.promise();
			promise.success = promise.done;
			promise.error = promise.fail;
			
			var ajax= $.ajax({
				type:'POST',
				dataType:'json',
				url:form.attr('action')+'/../checkValidation',
				data:form.serialize(),
			});
			ajax.success(function(data,status,xhr){
				
				 if (!data ) {
					deferred.reject(ajax, 'error');
				} else {
				
					deferred.resolve(data, status, xhr);
				}
					
			});
			ajax.error(function(jqXHR,textStatus,errorThrown){
				deferred.reject(jqXHR,textStatus,errorThrown)
			});
			return promise;
		}

		
		function init(){
		console.log('emailkmanager'+id);
			$(id).on('show', function () {
				cleanForm();
				$(this).find('.modal-bodyandfooter').show();
				$(this).find(' .modal-response').remove();
				//console.log($(this).find('form'));
				$(this).find('form')[0].reset();
				
			});
			bindEvents()
		}

		function bindEvents(){
		$(id+' form').submit(function(){
		console.log('submit'+id);
			var checkValid=validate();
			var form=$(this);
			checkValid.success(function(data){
			console.log('submit');
					if(data.errors) {
							onError(data.model,data.errors);
							return false;
					}
					else{
					//console.log(form.attr('method'));
					showLoader('<i class=\"icon-spinner icon-spin\"></i>');
						$.ajax({
							type:form.attr('method'),
							dataType:'json',
							url:form.attr('action'),
							data: form.serialize(),
							success:afterValidate,
							error:function(jqXHR,textStatus,errotThrown){
								console.log(jqXHR,textStatus,errotThrown)
							}
						});
					}
				});
					
						
				
				return false;
				

		});

		$(id+' form input').blur(function(){
			$(this).nextAll('.help-inline').remove();
			$(this).parents('.control-group').removeClass('error');
			var checkValid=validate();
			checkValid.success(function(data){
				if(data.errors) {
						onError(data.model,data.errors);
						return false;
					}
				});

			});
		}
		
		function afterValidate(data, status)  {
			removeLoader(),cleanForm();
			if(data.errors) {
				onError(data.model,data.errors);
				return false;
			} else {
				onSuccess(data.reponse)
				return true;
			}
		}

		function onError(model,errors) {

			$.each(errors, function(fieldName) {
			//console.log(this )
				for (message in this) {
					var element = $("#"+model+camelize(fieldName));
					console.log();
					if (element.nextAll('.help-inline').length==0){
						var _insert = $(document.createElement('span')).insertAfter(element);
						_insert.addClass('help-inline').text(this[message]);            
						_insert.closest('.control-group').addClass('error');
					}
					
				}
			});
		};


		function onSuccess(data) {
		console.log('email sent');
			$(id+' .modal-bodyandfooter').hide();	
			var reponse=$(document.createElement('div')).insertAfter($(id+ ' .modal-bodyandfooter')).addClass(' modal-response modal-body').html(data);
		};



		function camelize(string) {
			var a = string.split('_'), i;
			s = [];
			for (i=0; i<a.length; i++){
				s.push(a[i].charAt(0).toUpperCase() + a[i].substring(1));
			}
			s = s.join('');
			return s;
		}
	
		init();
	}
	
	}

