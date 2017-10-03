<div class="col-xs-12 col-without-padding">
	<div class="col-xs-12 col-without-padding">
		<nav style="margin-bottom:0px;" class="navbar navbar-default nav_primal">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav_primal" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="?page=home"><?= Config::$name_head_nav ?></a>
		    </div>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class=" navbar-collapse collapse" id="nav_primal">
		      <ul class="nav navbar-nav">
		        <li><?php echo (!isset($_SESSION['pseudo']))?'<a href="?page=sign_up">Créer un compte</a>' : ''; ?></li>	
	        	<li><?php echo (isset($_SESSION['level']) && $_SESSION['level'] == '3')?'<a href="?page=admin">Admin</a>' : ''; ?></li>			        
		        <li><?php echo (!isset($_SESSION['pseudo']))?'<a href="?page=login">Se connecter</a>' : ''; ?></li>
		        <li><?php echo (isset($_SESSION['pseudo']))?'<a href="?page=list_employer">Liste des employées</a>' : ''; ?></li>
		        <li><?php echo (isset($_SESSION['pseudo']))?'<a href="?page=my_account">Mon Compte</a>' : ''; ?></li>
		        <li><?php echo (isset($_SESSION['level']) && $_SESSION['level'] == '3')?'<a href="?page=test">Test</a>' : ''; ?></li>
		        <li class="dropdown">
		          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Un problème ?&nbsp;<span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><?php echo (isset($_SESSION['pseudo']))?'<a href="?page=contact">Contactez-moi</a>' : ''; ?></li>
		          </ul>
		        </li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li><?php echo (isset($_SESSION['pseudo']))?'<a href="?page=logout">Se déconnecter</a>' : ''; ?></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</div>
</div>
