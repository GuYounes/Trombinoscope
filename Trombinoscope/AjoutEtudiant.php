

<?php
include_once('log.php');
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$groupe=$_POST['groupe'];
$groupes = array();
$image = 'images/Image.png';
require_once("connexion_bdd.php");

$reponse = $bdd->query("SELECT * from groupe");
while($donnees = $reponse->fetch())
{
	$groupes[]=$donnees;
}

if(!in_array($groupe,$groupes))
{
	$ps=$bdd->prepare("INSERT INTO groupe(no_groupe) VALUES(?) ");
	$params=array($groupe);
	$ps->execute($params);
}

$ps=$bdd->prepare("INSERT INTO etudiant(nom_etu,prenom_etu,no_groupe,photo) VALUES(?,?,?,?) ");
$params=array(strtoupper(substr($nom,0,1)).strtolower(substr($nom,1,strlen($nom)-1)),strtoupper(substr($prenom,0,1)).strtolower(substr($prenom,1,strlen($prenom)-1)),$groupe,$image);
$ps->execute($params);
$id = $bdd->lastInsertId();
generer_log($id);

?>

<script type="text/javascript">
	document.location.href="accueil_admin.php";
</script>

