<?php

function generer_log($no_etu)
{

	require("connexion_bdd.php");
	include_once('mdp.php');

	$tableau=array();
	$redondance = array();
	$log;
	$pseudo;
	$req=$bdd->prepare('SELECT concat(substring(nom_etu,1,4),(substring(prenom_etu,1,4))) from etudiant where id_etu=?');
	$params=array($no_etu);
	$req->execute($params);
	foreach ($req as $pseudo) {
		$log=$pseudo[0];

	}

	$mdp= generer_mot_de_passe();
	
	$req=$bdd->query('SELECT * from log_etu where id_etu='.$no_etu);
	foreach ($req as $row) {
		$tableau[]=$row;
	}

	//REDONDANCE//

	$req=$bdd->query('SELECT * from etudiant where substring(nom_etu,1,4) = "'.substr($log,0,4).'" and substring(prenom_etu,1,4) = "'.substr($log,4,4).'"');
	foreach ($req as $row) {
		$redondance[]=$row;
	}

	if(count($redondance)==1)
	{
		if(count($tableau) == 1)
		{
			$req=$bdd->prepare('UPDATE log_etu SET  log = ?, mdp=? WHERE id_etu = ?');
			$params=array($log,$mdp,$no_etu);
			$req->execute($params);
		}
		elseif(count($tableau) == 0)
		{
			$req=$bdd->prepare('INSERT INTO log_etu (id_etu,log,mdp) values (?,?,?)');
			$params=array($no_etu,$log,$mdp);
			$req->execute($params);
		}
	}
	elseif(count($redondance)>1)
	{
		if(count($tableau) == 1)
		{
		$req=$bdd->prepare('UPDATE log_etu SET  log = ?, mdp=? WHERE id_etu = ?');
		$params=array($log.(count($redondance)-1),$mdp,$no_etu);
		$req->execute($params);
		}
		elseif (count($tableau) == 0)
		{
		$req=$bdd->prepare('INSERT INTO log_etu (id_etu,log,mdp) values (?,?,?)');
		$params=array($no_etu,$log.(count($redondance)-1),$mdp);
		$req->execute($params);
	}
	}


	
}

?>

