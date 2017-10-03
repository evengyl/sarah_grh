	<div class="col-xs-10 col-lg-offset-1 col-without-padding connect-form" style="margin-top:25px;">	
		<div class="col-xs-12" style="padding:15px;">
			Par le biai de cette page, vous pouvez me soumettre des requètes et me posez vos questions</br>
			Si vous avez déjà un compte c'est par ici : <a href="?page=login">Se connecter</a></br>
		</div>
		<form action="#" method="post" class="col-lg-6 col-lg-offset-3">

			<div  class="col-xs-12 form-group <?php echo (isset($_SESSION['error']))?'has-error':''; ?>">
				<?php echo (isset($_SESSION['error']))?'<label for="exampleInputPassword1" style="color:green;">'.$_SESSION['error'].'</label>':''; ?>
				<input name="pseudo" type="text" class="form-control " required placeholder="Pseudo">
			</div>
			<div  class="col-xs-12 form-group <?php echo (isset($_SESSION['error']))?'has-error':''; ?>">				
				<input name="email" type="mail" class="form-control " required placeholder="Adresse Email (pas de pub)">
			</div>


			<div  class="col-xs-12 form-group <?php echo (isset($_SESSION['error']))?'has-error':''; ?>">				
				<input name="text" type="text" class="form-control " required placeholder="Votre message">
			</div>

			<input type="hidden" name="key_safe" value="55157141">


			
			<input type="hidden" name="return_post_contact" value="1">
			<button type="submit" class="col-lg-4 btn btn-default">Envoyer</button>

		</form>
	</div>

