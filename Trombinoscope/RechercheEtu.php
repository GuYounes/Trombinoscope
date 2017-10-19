<?php 

if(isset($_POST['recherche']))
{
	require_once('connexion_bdd.php');
	$ps=$bdd->prepare('SELECT * FROM etudiant WHERE nom_etu like "'.$_POST['recherche'].'%" or prenom_etu like "'.$_POST['recherche'].'%" order by no_groupe, nom_etu');
	$params=array($_POST['recherche'],$_POST['recherche']);
	$ps->execute();
	//fetch recupere la ligne
	$resultat=$ps->fetch();

	echo'<tr>
			<td>'.$resultat['no_groupe'].'</td>
			<td>'.$resultat['nom_etu'].'</td>
			<td>'.$resultat['prenom_etu'].'</td>';
			if(isset($_SESSION['adminConnected']))
			{
			echo'<td><a href="EditEtudiant.php?code='.$resultat['id_etu'].'">Modifier</a></td>
			<td><a onclick="return confirm(\'Voulez-vous vraiment supprimer cet élève ?\');" href="SupprimerEtudiant.php?code='.$resultat['id_etu'].'">Supprimer</a></td>';
		}
	echo'</tr>';
}

?>