
<?php
session_start();
if(isset($_SESSION['profConnected']))
{
	include("header/menu_prof.html");
	var_dump($_SESSION['profConnected']);
}
else
{
	include("header/menu_admin_ajout.html");
}
include('VerifConnexion.php');
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

<form method="post" action="AjoutEtudiant.php" enctype="multipart/form-data">
		<div class="form-group">
				<label class="control-label">Nom</label>   
				<input type="text" name="nom" class="form-control" placeholder="Nom" required/>

		</div>   
		<div class="form-group">
				<label class="control-label">Prenom</label>   
				<input type="text" name="prenom" class="form-control" placeholder="Prénom" required/>

		</div>  
		
		<div class="form-group" >
				<label class="control-label">Groupe </label>   
				<input type="number" name="groupe" class="form-control"  placeholder="Groupe" required/>

		</div>  

		<div style = "height: 80px;"> 

		<div><button style = " position:relative; float:left;margin-left:2%; " class="btn btn-info" type="submit">Enregistrer</div></button>


    <form >
  		<input style = " position:relative; float:left;margin-left:2%; " class="btn btn-info" type="button" value="Retour" onclick="document.location.href='accueil_admin.php'">
    </form>

    </div>
</form>

</div>


</div>


</div>



</body>
</html> 