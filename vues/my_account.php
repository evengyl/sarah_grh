<div class="col-xs-12 col-xs-12 col-without-padding col-without-radius content_game">
	<div class="col-lg-6" style="margin-top:1px;"><?

		if($_GET['page'] == "password_change")
		{?>
			<div class="col-xs-12 explication pull-left">
				<h2 class="title">Changement de mot de passe</h2>
				<h3 class="sub_title">Le mot de passe doit contenir au moins 6 caractères</h3>
			</div>
	
			<form action="#" method="post" class="">
				<div  class="col-xs-12 form-group <?php echo (isset($_SESSION['error']))?'has-error':''; ?>">
					<?php echo (isset($_SESSION['error']))?'<label for="exampleInputPassword1" style="color:green">'.$_SESSION['error'].'</label><br/>':''; ?>
					<label style="color:white">Pour le Pseudo :</label>
					<input disabled name="pseudo" type="text" class="form-control " id='disabledInput' value="<?= $user->user_infos->login; ?>">
				</div>

				<div  class="col-xs-12 form-group <?php echo (isset($_SESSION['error']))?'has-error':''; ?>">
					<label style="color:white">Nouveau mot de passe</label>					
					<input name="password-new_1" required placeholder="Mot de passe" type="password" class="form-control" value="">
				</div>

				<div  class="col-xs-12 form-group <?php echo (isset($_SESSION['error']))?'has-error':''; ?>">
					<label style="color:white">Confirmation du nouveau mot de passe</label>					
					<input name="password-new_2" required placeholder="Confirmation du Mot de passe" type="password" class="form-control" value="">
				</div>

				<input type="hidden" name="return_post_account_pass_change" value="18041997">
				<button type="submit" class="col-lg-4 btn btn-default">Envoyer</button>
			</form><?
		}

		else if($_GET['page'] == "mail_box")
		{?>
			<div class="col-xs-12 explication pull-left">
				<h2 class="title">Boite de messageries</h2>
			</div>
	
			__MOD_mail_box__<?
		}?>
	</div>
	__TPL_nav_my_account__
</div>


<? unset($_SESSION['error']); // permet de ne pas afficher les erreurs de connection si on reload la page ?>