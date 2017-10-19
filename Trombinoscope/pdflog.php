<?php

require_once("connexion_bdd.php");
require_once('lib/mpdf60/mpdf.php');

$mpdf = new mPDF();
ob_clean();
ob_start();

if(!isset($_GET['groupe']))
{

	echo '	<h1>Groupe ' .$_GET['groupe'] . '</h1>

	<h2> Log et Mot de Passe </h2>
	<table style=" border-collapse: separate; border-spacing: 33px 20px;">
				<thead>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</thead>
				<br><br><br><br>
				<tbody>';
				$etudiants=$bdd->prepare("SELECT nom_etu,prenom_etu,log_etu.log, log_etu.mdp FROM log_etu,etudiant WHERE etudiant.id_etu = log_etu.id_etu and etudiant.no_groupe like ?");
		$params=array('%');
		$etudiants->execute($params);
			foreach($etudiants as $e){
				$nom = $e['nom_etu'];
				$prenom = $e['prenom_etu'];
				$log = $e['log'];
				$pwd = $e['mdp'];
		echo '	<tr>
					<td>' . $nom . '</td>
					<td>' . $prenom. '</td>
					<td>' . $log . '</td>
					<td>' . $pwd . '</td>
					<td>https://infodb.iutmetz.univ-lorraine.fr/~guarssif3u/Trombinoscope</td>
				</tr>
					
				<tr>
				<td colspan = "5">________________________________________________________________________________________________________________________________________________________________</td></tr>';


	}
	echo '</tbody></table>';

}
elseif(isset($_GET['groupe']))
	{

	echo '	<h1>Groupe ' .$_GET['groupe'] . '</h1>

	<h2> Log et Mot de Passe </h2>
	<table style=" border-collapse: separate; border-spacing: 33px 20px;">
				<thead>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</thead>
				<br><br><br><br>
				<tbody>';
				$etudiants=$bdd->prepare("SELECT nom_etu,prenom_etu,log_etu.log, log_etu.mdp FROM log_etu,etudiant WHERE etudiant.id_etu = log_etu.id_etu and etudiant.no_groupe = ?");
		$params=array($_GET['groupe']);
		$etudiants->execute($params);
			foreach($etudiants as $e){
				$nom = $e['nom_etu'];
				$prenom = $e['prenom_etu'];
				$log = $e['log'];
				$pwd = $e['mdp'];
		echo '	<tr>
					<td>' . $nom . '</td>
					<td>' . $prenom. '</td>
					<td>' . $log . '</td>
					<td>' . $pwd . '</td>
					<td>https://infodb.iutmetz.univ-lorraine.fr/~guarssif3u/2A/PROJET_WEB/index.php</td>
				</tr>
					
				<tr>
				<td colspan = "5">________________________________________________________________________________________________________________________________________________________________</td></tr>';


	}
	echo '</tbody></table>';

}

$template = ob_get_contents();
			ob_end_clean();

			$mpdf->WriteHTML($template);
			$mpdf->Output();

?>