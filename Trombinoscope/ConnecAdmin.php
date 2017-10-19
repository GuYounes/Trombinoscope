<link rel="stylesheet" type="text/css" href="connect.css">
<form method="post">


<?php 
include("header/menu_connec.html");

	session_start();
	if(isset($_SESSION['adminConnected'])){ // Deconnexion administrateur
		$_SESSION['adminConnected'] = null;
		session_destroy();
		header("location:ConnecAdmin.php");
	}
	if(isset($_SESSION['userConnected'])){ // Deconnexion étudiant
	
		$_SESSION['userConnected'] = null;
		session_destroy();
		header("location:ConnecAdmin.php");
	}

	if(isset($_SESSION['profConnected'])){ // Deconnexion prof
	
		$_SESSION['profConnected'] = null;
		session_destroy();
		header("location:ConnecAdmin.php");
	}
	
	if((!isset($_SESSION['adminConnected'])) && (!isset($_SESSION['userConnected'])) && (!isset($_SESSION['profConnected'])) ){ // Si aucune connexion n'existe
		echo 	'<div id="connection">
					<fieldset>
					<legend>Trombinoscope</legend>
					<input id="log" type="text" name="id" placeholder="Identifiant"><br>
					<input id="pwd" type="password" name="pwd" placeholder="Mot de passe"><br>
					</fieldset>
					<input id="subConnection" type="submit" name="connect" value="Se connecter">
				</div>';

				
		if(isset($_POST['connect'])){
			$id = $_POST['id']; //Identifiant submit
			$pwd = $_POST['pwd']; //Mot de passe submit
			
			if($id!='' && $pwd!=''){ // si les log existe
				require_once('rq_connexion.php');
				$admin = adminConnection($id, $pwd);
				$user = userConnection($id, $pwd);
				$prof = profConnection($id,$pwd);
				if($admin != null){ // On vérifie les log côté admin
					foreach($admin as $a){ 
						$adminPwd = $a['mdp_admin'];
						$adminId = $a['nom_admin'];
						if(($id == $adminId) && ($pwd == $adminPwd)){
							$_SESSION['adminConnected'] = true;
							header("location:accueil_admin.php");
						}
					}
				}
				else if($user != null){ // Sinon on la vérifie côté étudiant
					foreach($user as $u){
						$userId = $u['log'];
						$userPwd = $u['mdp'];
						$log=$u['id_etu'];
						if(($id = $userId) && ($pwd == $userPwd)){
							$_SESSION['userConnected'] = true;


							header("location:accueil_etudiant.php?id_etu=".$log);
						}
					}
				}

				else if($prof != null){ // Sinon on la vérifie côté étudiant
					foreach($prof as $u){
						$profId = $u['log'];
						$profPwd = $u['mdp'];
						if(($id = $profId) && ($pwd == $profPwd)){
							$_SESSION['profConnected'] = true;


							header("location:accueil_admin.php");
						}
					}
				}
				else echo '<p class="logError">Identifiants inconnus</p>'; //Sinon identifiants inconnus
			}
			else echo '<p class="logError">Veuillez remplir les champs de connexion</p>';
		}
	}
?>
</form>