	<!-- prototype menu droite -->
	<style>
	
	.nav-sidebar{
	min-height:0px !important;
	padding:0;
	margin-bottom:30px;
	list-style-type:none;
}
	
	.nav-sidebar>li:first-child{
	-webkit-border-radius: 3px 3px 0 0;
	-moz-border-radius: 3px 3px 0 0;
	border-radius: 3px 3px 0 0;
	}
	
	.nav-sidebar>li:last-child{
	-webkit-border-radius: 0 0 3px 3px;
	-moz-border-radius: 0 0 3px 3px;
	border-radius:  0 0 3px 3px;
	}
	
	
	.nav-sidebar > li > a{
		display:block;
		margin:0 0 -1px;
		padding:8px 14px;
		border:1px solid #dddddd;
	}
	.nav-sidebar>li:last-child a{
		border-bottom:none;
	}
	#UserLoginForm{
	display:none;
	padding:14px;
	/*augmentation margin a cause des icons sur input*/
	margin-right:30px;
	
	}
	
	#UserLoginForm input[type="text"]{

	
	}
	
	
	
	</style>
	<script>
$(function() {
	
	var form =$("#UserLoginForm");
	form.find('input').focus(function(){
	console.log('focus');
		cleanForm()
	});
	
	
	$("#showlogin").click(function(){
		form.fadeToggle();
		cleanForm();
		return false;
	});
	
	function cleanForm(){
			 form .find('.help-inline').remove();
			form .find('.error').each(function() {
				$(this).removeClass("error");
			});
		};
		
	function onErrors(errors){
	var element=form.find('input[type="submit"]')
		var _insert = $(document.createElement('span')).insertAfter(element);
		_insert.addClass('help-inline').text(errors); 
		_insert.css('color','#b94a48');
		//_insert.closest('.control-group').addClass('error');
	}
	
	form.submit(function(){
		var that=$(this);
		$.ajax({
			type:that.attr('method'),
			dataType:'json',
			url:that.attr('action'),
			data: that.serialize(),
			success:function(data){
				console.log(data)
				if (data.errors){
					onErrors(data.errors)
				}
				else{
					var redirectUrl=jsRoot.replace(/\/$/, "")+data.redirectUrl
					//console.log(jsRoot.replace(/\/$/, "")+data.redirectUrl)
					
					window.location.replace(redirectUrl)
				}
			}
		});
		return false;
	});
	
});
	
	
	
	

	 
	
</script>
<!--nocache-->

		<ul class="nav-sidebar qbox  nav-list">
		<?php if(AuthComponent::user('username')): ?>
			<li>
			<?php echo $this->Html->link(' <i class="icon-signout"></i> Se déconnecter', array(
										'plugin'=>false,
										'controller'=>'Users',
										'action'=>'logout'
										),
										array('escape'=>false))
					?>
				</li>
				<li><a href="#"><i class="icon-cogs"></i> Modifier mes informations de connexion</a></li>
		<?php else: ?>
  <li><a href="#" id="showlogin" ><i class="icon-signin"></i> Se connecter</a>
  <?php echo $this->Form->create('User',array('plugin'=>false,'controller'=>'Users', 'action'=>'login','url'=>'/Users/login')); ?>
		<div class="input-prepend">
			<span class="add-on"><i class="icon-user"></i></span>
		<?php echo $this->Form->input('username', array('div'=>false,'label'=>false,'class'=>'input-block-level','placeholder'=>'identifiant'));?>
		</div>
		<div class="input-prepend">
			<span class="add-on"><i class="icon-key"></i></span>
				<?php echo $this->Form->input('password', array('div'=>false,'label'=>false,'class'=>'input-block-level','placeholder'=>'mot de passe'));?>
		</div>
		<div class="control-group ">
			<div class="controls">
				<input type="submit" class="btn" value="valider">
				<!--<span class="help-inline" style="color:#b94a48">identifiant ou mot de passe incorrect</span>-->
			</div>
		</div>
	<hr>
		<a href="#"> S'inscrire</a><br>
		<a href="#">mot de passe oublié ?</a>
		</form>
  	
  </li>
	<?php endif; ?>
</ul>
<!--/nocache-->
	<!-- fin  prototype menu droite-->	