<?php
session_start();

	include("header/menu_admin_ajout.html");
if(!isset($_SESSION['adminConnected'])){header('Location:accueil_admin.php');}
$code=$_GET['code'];
require_once('connexion_bdd.php');
$ps=$bdd->prepare("SELECT * FROM etudiant WHERE id_etu=?");
$params=array($code);
$ps->execute($params);
//fetch recupere la ligne
$etudiant=$ps->fetch();

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/myStyle.css"/>
</head>

<body>



<div class=" container spacer col-md-6 col-xs-12 col-md-offset-3">
<div class="panel panel-default">
<div class="panel-heading">Saisie des étudiants</div>
<div class="panel-body">

<?php echo'<form method="post" action="UpdateEtudiant.php?code='.$code.'" enctype="multipart/form-data">' ?>
<div class="form-group">
				<label class="control-label">Numéro étudiant <?php echo($etudiant['id_etu'])?> </label  >   
				<input type="hidden" name="id" value="<?php echo($etudiant['id_etu'])?>" class="form-control"/>

		</div>   

		<div class="form-group">
				<label class="control-label">Nom: </label>   
				<input type="text" name="nom" value="<?php echo($etudiant['nom_etu'])?>" class="form-control" required/>

		</div>   
		<div class="form-group">
				<label class="control-label">Prenom: </label>   
				<input type="text" name="prenom" value="<?php echo($etudiant['prenom_etu'])?>" class="form-control" required/>

		</div>  

		<div class="form-group">
		<label class="control-label">Groupe: </label>
		<input type="text" name="groupe" value="<?php echo($etudiant['no_groupe'])?>" class="form-control" required/>

		</div> 

		</div>  
		<div><button type="submit">Enregistrer</div></br>


    <form>
  		<input type="button" value="Retour" onclick='document.location.href="accueil_admin.php"'>
    </form>



</form>

</div>


</div>


</div>


</body>
</html> 