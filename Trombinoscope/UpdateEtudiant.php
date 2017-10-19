
<?php
require_once("connexion_bdd.php");

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$id=$_POST['id'];
$groupe=$_POST['groupe'];
$gr;
$existe = array();

$ps=$bdd->prepare("SELECT no_groupe FROM etudiant where id_etu = ?");
$params=array($_GET['code']);
$ps->execute($params);
foreach ($ps as $donnees)
		{
			$gr = $donnees['no_groupe'];
		}

$ps=$bdd->prepare("UPDATE etudiant SET nom_etu=?, prenom_etu=?, no_groupe=? WHERE id_etu=? ");
$params=array(strtoupper(substr($nom,0,1)).strtolower(substr($nom,1,strlen($nom)-1)),strtoupper(substr($prenom,0,1)).strtolower(substr($prenom,1,strlen($prenom)-1)),$groupe,$id);
$ps->execute($params);
include('log.php');
generer_log($id);


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

$ps=$bdd->prepare("SELECT * FROM etudiant where no_groupe = ?");
$params=array($gr);
$ps->execute($params);
foreach ($ps as $donnees)
		{
			$existe[] = $donnees['id_etu'];
		}

if(count($existe) == 0)
{
	$ps=$bdd->prepare("DELETE FROM groupe where no_groupe = ?");
	$params=array($gr);
	$ps->execute($params);
	var_dump($ps->execute($params));
}

header('Location:accueil_admin.php')

?>
