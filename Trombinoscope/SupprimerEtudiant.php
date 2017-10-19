
<?php

$code=$_GET['code'];
require_once('connexion_bdd.php');
$existe = array();

$ps=$bdd->prepare("SELECT no_groupe FROM etudiant where id_etu = ?");
$params=array($code);
$ps->execute($params);
$et=$ps->fetch();
$groupe=$et['no_groupe'];

$ps=$bdd->prepare("DELETE FROM etudiant WHERE id_etu=?");
$params=array($code);
$ps->execute($params);

$ps=$bdd->prepare("SELECT * FROM etudiant where no_groupe = ?");
$params=array($groupe);
$ps->execute($params);
foreach ($ps as $donnees)
		{
			$existe[] = $donnees['id_etu'];
		}

if(count($existe) == 0)
{
	$ps=$bdd->prepare("DELETE FROM groupe where no_groupe = ?");
	$params=array($groupe);
	$ps->execute($params);
	var_dump($ps->execute($params));
}


header("location:accueil_admin.php");
?>