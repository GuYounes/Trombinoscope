<?php

	function adminConnection($id, $pwd){
		include("connexion_bdd.php");
		
		$admin = array();
		
		$req = $bdd->prepare('SELECT * FROM admin WHERE nom_admin="' . $id . '" AND mdp_admin="' . $pwd . '"');
		$req->execute();
		foreach($req as $r){
			$admin [] = $r;
		}
		$bdd = null;
		$req = null;
		return $admin;
	}
	
	function userConnection($id, $pwd){
		include("connexion_bdd.php");
		
		$user = array();
		
		$req = $bdd->prepare('SELECT * FROM log_etu WHERE log="' . $id . '" AND mdp="' . $pwd . '"');
		$req->execute();
		foreach($req as $r){
			$user [] = $r;
		}
		$bdd = null;
		$req = null;
		return $user;
	}

	function profConnection($id, $pwd){
		include("connexion_bdd.php");
		
		$user = array();
		
		$req = $bdd->prepare('SELECT * FROM log_prof WHERE log="' . $id . '" AND mdp="' . $pwd . '"');
		$req->execute();
		foreach($req as $r){
			$user [] = $r;
		}
		$bdd = null;
		$req = null;
		return $user;
	}
?>