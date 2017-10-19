<?php

require_once("connexion_bdd.php");
require_once('lib/mpdf60/mpdf.php');

$mpdf = new mPDF();
ob_clean();
ob_start();

if(isset($_GET['groupe']))
{
	echo'<h1>Groupe '.$_GET['groupe'].' </h1>
	<table style=" border-collapse: separate; border-spacing: 33px 20px;">
	</thead>
		<tbody>
			<tr>';


		$etudiants=$bdd->prepare("SELECT nom_etu, prenom_etu, photo FROM etudiant where no_groupe = ?");
		$params=array($_GET['groupe']);
		$etudiants->execute($params);
			$compt=0;
			foreach($etudiants as $e){
				if($compt == 6){
					echo '</tr><tr>';
					$compt=0;
				}
				$nom = $e['nom_etu'];
				$prenom = $e['prenom_etu'];
				$photo = $e['photo'];

				echo '<td><img width="100" height="100" src="' . $photo . '">';

				echo '<p>' . $nom . '<br>' . $prenom . '</p></td>';
				$compt++;
			}

		echo'</tr>
		<tr>
			<td></td>
		</tr>
	</tbody>
</table>';

}
else
{
	echo'<h1>Tous les groupes </h1>
	<table style=" border-collapse: separate; border-spacing: 33px 20px;">
	</thead>
		<tbody>
			<tr>';


		$etudiants=$bdd->prepare("SELECT nom_etu, prenom_etu, photo FROM etudiant order by no_groupe, nom_etu");
		$etudiants->execute();
			$compt=0;
			foreach($etudiants as $e){
				if($compt == 6){
					echo '</tr><tr>';
					$compt=0;
				}
				$nom = $e['nom_etu'];
				$prenom = $e['prenom_etu'];
				$photo = $e['photo'];

				echo '<td><img width="100" height="100"  src="' . $photo . '">';

				echo '<p>' . $nom . '<br>' . $prenom . '</p></td>';
				$compt++;
			}

		echo'</tr>
		<tr>
			<td></td>
		</tr>
	</tbody>
</table>';
}

$template = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($template);
$mpdf->Output();

?>