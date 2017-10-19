<?php
session_start();
if(isset($_SESSION['profConnected']))
{
	include("header/menu_prof.html");
}
else
{
	include("header/menu_admin_ajout.html");
}
include('VerifConnexion.php');

require_once("connexion_bdd.php");

echo'<div style = "height: 80px;  ">';

echo'<div style = " position:relative; float:left;margin-left:2%; ">';
echo '<form method ="POST" action = "accueil_admin.php">';

	$nbGroupe;
	$groupes=array();
	$req='SELECT no_groupe from groupe ';
	foreach ($bdd->query($req) as $donnees)
	{

		$groupes[] = $donnees['no_groupe'];
		$nbGroupe = count($groupes);
	}

    	echo'<select methode="post" class="form-control" name="groupe" style="width:200px;margin-left:2%;">';

    	if(!empty($_POST['groupe'])) {echo '<option value="'.$_POST['groupe'].'">'.$_POST['groupe'].'</option>';}

        if($_POST['groupe'] != 'Tous les groupes') {echo '<option   value ="Tous les groupes">Tous les groupes</option>';}

            foreach($groupes as $groupe)
            {
            	if(isset($_POST['groupe']))
          		{
  					preg_match_all('#[0-9]+#', $_POST['groupe'] ,$matches);
		            if ($groupe==$matches[0][0])
		            {
						1;
		            }
	            	else
		            {
		           		 echo '<option value ="Groupe '.$groupe.'">Groupe '.$groupe.' </option>';
		            }
	        	}
	        	else
	        	{
	        	 echo '<option value ="Groupe '.$groupe.'">Groupe '.$groupe.' </option>';
	        	}
			}

			 echo '</select>';

			 echo'<input type ="submit" size="5" value="Afficher" name="afficher" style="margin-left:2%;" class="btn btn-info"></br>'; 

 			 echo '</form>';	
echo'</div>';

echo'<div style = " position:relative; float:left;margin-left:2%; ">';
echo'<form method = "POST" action="accueil_admin.php" name="recherche"  >';
echo'<input type="text" name="recherche" placeholder="Rechercher..." class="form-control" style="width:200px;margin-left:2%;" required>';
echo'<input type ="submit" size="5" value="Rechercher"  style="margin-left:2%;" name="rechercher" class="btn btn-info" ></br>';
echo '</form>';
echo'</div>';

echo'</div>';


$req="SELECT * FROM etudiant order by no_groupe";
$ps=$bdd->prepare($req);
$ps->execute();
?>
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/myStyle.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
</br>

<div class="col-md-12 col-xs-12 spacer" >
<div class="panel panel-info spacer">
<div class="panel-heading">Liste des étudiants</div>
<div class="panel-body"><table class="table table-striped">
<thead>
<tr>
<th>NO_GROUPE</th><th>NOM</th><th>PRENOM</th>
</tr>
</thead>
<tbody>
<?php 	

include('RechercheEtu.php');

while($et=$ps->fetch()){

	if(isset($_POST['groupe']))
	{
		if(preg_match_all('#[0-9]+#', $_POST['groupe'] ,$matches) != 0)
		{


		if($et['no_groupe']==$matches[0][0])
		{
		echo'<tr>
			<td>'.$et['no_groupe'].'</td>
			<td>'.$et['nom_etu'].'</td>
			<td>'.$et['prenom_etu'].'</td>';
			if(isset($_SESSION['adminConnected']))
			{
			echo'<td><a href="EditEtudiant.php?code='.$et['id_etu'].'">Modifier</a></td>
			<td><a onclick="return confirm(\'Voulez-vous vraiment supprimer cet élève ?\');" href="SupprimerEtudiant.php?code='.$et['id_etu'].'">Supprimer</a></td>
</tr>';}
}
}
else if($_POST['groupe']=='Tous les groupes')
{
		echo'<tr>
			<td>'.$et['no_groupe'].'</td>
			<td>'.$et['nom_etu'].'</td>
			<td>'.$et['prenom_etu'].'</td>';
			if(isset($_SESSION['adminConnected']))
			{
			echo'<td><a href="EditEtudiant.php?code='.$et['id_etu'].'">Modifier</a></td>
			<td><a onclick="return confirm(\'Voulez-vous vraiment supprimer cet élève ?\');" href="SupprimerEtudiant.php?code='.$et['id_etu'].'">Supprimer</a></td>
</tr>';}
}
}
else
{
echo'<tr>
			<td>'.$et['no_groupe'].' </td>
			<td>'.$et['nom_etu'].'</td>
			<td>'.$et['prenom_etu'].'</td>';
			if(isset($_SESSION['adminConnected']))
			{
			echo'<td><a href="EditEtudiant.php?code='.$et['id_etu'].'">Modifier</a></td>
			<td><a onclick="return confirm(\'Voulez-vous vraiment supprimer cet élève ?\');" href="SupprimerEtudiant.php?code='.$et['id_etu'].'">Supprimer</a></td>
</tr>';}
}
}
?>
</table></div>
</div>




</div>


<div id="scrollUp">
<a href="#top"><img src="btn/to_top.png"/></a>
</a>
<link href='btn/btn.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script>
jQuery(function(){
$(function () {
$(window).scroll(function () {
if ($(this).scrollTop() > 200 ) { 
$('#scrollUp').css('left','10px');
} else { 
$('#scrollUp').removeAttr( 'style' );
}
 
});
});
});
</script>


</div>
</tbody>
</body>
</html>