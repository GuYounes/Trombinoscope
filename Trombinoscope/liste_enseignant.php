<?php
session_start();
if(!isset($_SESSION['adminConnected'])){header('Location:accueil_admin.php');}
include("header/menu_admin_ajout.html");
require_once("connexion_bdd.php");


$req="SELECT nom_prof, prenom_prof, log, mdp from professeur, log_prof";
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
<th>NOM</th><th>PRENOM</th><th>IDENTFIANT</th><th>MOT DE PASSE</th>
</tr>
</thead>
<tbody>
<?php 	

include('RechercheEtu.php');

while($et=$ps->fetch()){

	echo'<tr><td>'.$et['nom_prof'].'</td>';
	echo'<td>'.$et['prenom_prof'].'</td>';
	echo'<td>'.$et['log'].'</td>';
	echo'<td>'.$et['mdp'].'</tr></td>';
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

