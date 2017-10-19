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

echo '<form method ="POST" action = "logetmdp.php">';

	$nbGroupe;
	$groupes=array();
	$req='SELECT no_groupe from groupe ';
	foreach ($bdd->query($req) as $donnees)
	{

		$groupes[] = $donnees['no_groupe'];
		$nbGroupe = count($groupes);
	}


    	echo'<select methode="post" class="form-control" name="groupe" style="width:15%;margin-left:2%;">';
		
    	if(!empty($_POST['groupe'])) {echo '<option value="'.$_POST['groupe'].'">'.$_POST['groupe'].'</option>';}
        if($_POST['groupe'] != 'Tous les groupes') {echo '<option   value ="Tous les groupes">Tous les groupes</option>';}
            foreach($groupes as $groupe)
            {
            if ($groupe==substr($_POST['groupe'],-1))
            {
            	1==1;
            }
            else
            {
           		 echo '<option   value ="Groupe '.$groupe.'">Groupe '.$groupe.' </option>';
            }

			 }
			 	echo'<input  type ="submit" size="5" value="Afficher"   style="margin-left:2%;"    name="afficher" class="btn btn-info">'; 


			 echo '</form>';
			 echo '</select>';


$req="SELECT etudiant.no_groupe,log_etu.log, log_etu.mdp, nom_etu, prenom_etu FROM log_etu,etudiant WHERE etudiant.id_etu = log_etu.id_etu  order by no_groupe, log";
$ps=$bdd->prepare($req);
$ps->execute();
?>
<html>
<head>
</br>
<title>Login & mot de passe</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/myStyle.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>

<div class="col-md-12 col-xs-12 spacer" >
<div class="panel panel-info spacer">
<div class="panel-heading">Login & mot de passe</div>
<div class="panel-body"><table class="table table-striped">
<thead>
<tr>
<th>NO_GROUPE</th><th>Nom</th><th>Prenom</th><th>Pseudo</th><th>Mot de passe</th>
</tr>
</thead>
<tbody>
<?php while($et=$ps->fetch()){
	if(isset($_POST['groupe']))
	{
		if(preg_match_all('#[0-9]+#', $_POST['groupe'] ,$matches))
		{
		if($et['no_groupe']==$matches[0][0])
		{
		echo'<tr>
			<td>'.$et['no_groupe'].'</td>
			<td>'.$et['nom_etu'].'</td>
			<td>'.$et['prenom_etu'].'</td>
			<td>'.$et['log'].'</td>
			<td>'.$et['mdp'].'</td>
			
</tr>';
}
}
else if($_POST['groupe']=='Tous les groupes')
{
		echo'<tr>
			<td>'.$et['no_groupe'].'</td>
			<td>'.$et['nom_etu'].'</td>
			<td>'.$et['prenom_etu'].'</td>
			<td>'.$et['log'].'</td>
			<td>'.$et['mdp'].'</td>
			
</tr>';
}
}
else
{
echo'<tr>
			<td>'.$et['no_groupe'].' </td>
			<td>'.$et['nom_etu'].'</td>
			<td>'.$et['prenom_etu'].'</td>
			<td>'.$et['log'].'</td>
			<td>'.$et['mdp'].'</td>
			
</tr>';
}
}
?>
</tbody>
</table>
</div>
</div>

<table align="right">

<?php
 if(isset($_POST['groupe']) && $_POST['groupe'] != "Tous les groupes")
 { 
 	preg_match_all('#[0-9]+#', $_POST['groupe'] ,$matches);
 	echo'<td width="200"><a target="_blank" href="pdflog.php?groupe='.$matches[0][0].'" class="btn btn-danger">Exporter en PDF</a></td>';
 }
 else echo'<td width="200"><a target="_blank" href="pdflog.php" class="btn btn-danger">Exporter en PDF</a></td>';
  ?>
  
  </table>
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
$('#scrollUp').css('right','10px');
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
