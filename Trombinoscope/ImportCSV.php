<?php
session_start();
include("header/menu_admin_ajout.html");
if(!isset($_SESSION['adminConnected'])){header('Location:accueil_admin.php');}
?>


<!DOCTYPE html>
<html>
<head>
	<!-- <link rel="stylesheet" href="style/style1.css" /> -->
</head>


<div style="display:inline-block" class=" container spacer col-md-6 col-xs-12 col-md-offset-3">
<div class="panel panel-default">
<div class="panel-heading">Import de fichier CSV </div>
<div align="center"  class="panel-body">

<form name="importation" method="post" enctype="multipart/form-data">
		<div class="form-group">
				<label class="control-label">Votre fichier</label>   
				<input name="file" type="file" value="table" required/>

		</div>   
		

		<div align="center" style = "height: 80px; margin-left: 38%;"> 

		<div ><input style = " position:relative; float:left;margin-left:2%; " class="btn btn-info" type="submit" value="Importer" name= "import_bdd"/></div>

	<div>
    <form>
  		<input style = " position:relative; float:left;margin-left:2%; " class="btn btn-info" type="button" value="Retour" onclick="document.location.href='accueil_admin.php'">
    </form>

    </div>

    </div>
</form>

</div>


</div>


</div>
<div style="display:inline-block"">


<?php
$upload=false;
$lacune=false;
	if(isset($_FILES['file']['name']) ){
		if(strrchr($_FILES['file']['name'], '.') != '.csv'){
			echo 'Veuillez selectionner un fichier de type .csv';
		}
		else{
			$dossier = 'csv/';
			$fichier = basename($_FILES['file']['name']);
			if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			{ 
				$table = fopen($dossier . $_FILES['file']['name'],"r");

				while($tab=fgetcsv($table,1024,';')){
					$champs = count($tab);//nombre de champ dans la ligne en question	
					
					
					/*if(!in_array($_POST['grp_import'],$grp_etu)){*///on vérifie ensuite si le grp de l'étudiant n'est pas dans cette liste
						try{
							if(strlen($tab[0])>0 && strlen($tab[1])>0 && isset($tab[2])>0){

								/*require_once("connexion_bdd.php");*/
								/*$ps=$bdd->prepare("INSERT INTO etudiant(nom_etu,prenom_etu,no_groupe) VALUES(?,?,?) ");
								$params=array($tab[0],$tab[1],$tab[2]);
								$ps->execute($params);*/

								$_POST['nom']= $tab[0];
								$_POST['prenom']= $tab[1];
								$_POST['groupe']= $tab[2];

								require('AjoutEtudiant.php');

								/*$id = $bdd->lastInsertId();		
								include_once('log.php');
								generer_log($id);*/

								$upload=true;
							}
							else{
								$lacune=true;
								throw new Exception();
							}
						}catch(Exception $e){
							echo $e->getMessage();
						}
					/*}
					else echo ("Erreur : Cet étudiant existe déjà dans le groupe ". $grp_select ." !</p>");*/
				}
			}
			else //Sinon (la fonction renvoie FALSE).
			{
			echo 'Echec de l\'upload !';
			}
		}
	}
	if($upload)
	{
		echo'Upload effectué avec succès';
	}
	if($lacune)
	{
		echo'Un des champs est vide dans le fichier';
	}

	?>
</div>
</body>
	</html>



