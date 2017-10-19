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

echo '<form method ="POST" action = "trombi.php">';

	$nbGroupe;
	$groupes=array();
	$req='SELECT no_groupe from groupe ';
	foreach ($bdd->query($req) as $donnees)
	{

		$groupes[] = $donnees['no_groupe'];
		$nbGroupe = count($groupes);
	}

    	echo'<select methode="post" class="form-control" name="groupe" style="width:200px;margin-left:2%;">';

    	if(!empty($_POST['groupe'])) {echo '<option value="'.$_POST['groupe'].'">'.$_POST['groupe'].'</option>';}

        if($_POST['groupe'] != 'Tous les groupes') {echo '<option   value ="Tous les groupes">Tous les groupes</option>';}

            foreach($groupes as $groupe)
            {
            	if(isset($_POST['groupe']))
          		{
  					preg_match_all('#[0-9]+#', $_POST['groupe'] ,$matches);
		            if ($groupe==$matches[0][0])
		            {
						1;
		            }
	            	else
		            {
		           		 echo '<option value ="Groupe '.$groupe.'">Groupe '.$groupe.' </option>';
		            }
	        	}
	        	else
	        	{
	        	 echo '<option value ="Groupe '.$groupe.'">Groupe '.$groupe.' </option>';
	        	}
			}

			 echo '</select>';

			 echo'<input type ="submit" size="5" value="Afficher" name="afficher" style="margin-left:2%;" class="btn btn-info"></br>'; 

 			 echo '</form>';	


$req="SELECT * FROM etudiant order by no_groupe,nom_etu";
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
<div class="panel-heading">Trombinoscopes des étudiants</div>
<div class="panel-body">
<table style=" border-collapse: separate; border-spacing: 33px 20px; margin-left: 2%; margin-right: 2%">
<tr>

<?php 

echo '
		<div class="left">';
		echo'<div style="padding: 10px; margin: 10px; font-family: Arial; line-height: 18px;"';

	while($e=$ps->fetch()){

		if(isset($_POST['groupe']))
		{
			if(preg_match_all('#[0-9]+#', $_POST['groupe'] ,$matches))
			{
				if($e['no_groupe']==$matches[0][0])
				{

				$nom = $e['nom_etu'];
				$prenom = $e['prenom_etu'];
				$photo = $e['photo'];
				?>
<ul style="display: inline-block;">
				<?php
				
					echo '
						<ul style="display: inline-block;">
							<li style="list-style: none; text-align: center;"><img style="border: 1px solid grey; box-shadow: 3px 3px 3px grey;" src="' . $photo . '" alt="' . $nom . ' ' . $prenom . '" width="100" height="100"></li>

							<li style="list-style: none; text-align: center;">'.$nom .'</li>
							<li style="list-style: none; text-align: center;">'.$prenom .'</li>
						</ul> </ul> ';

				}
			}

			else if($_POST['groupe']=='Tous les groupes')
			{
			$nom = $e['nom_etu'];
				$prenom = $e['prenom_etu'];
				$photo = $e['photo'];
								?>
<ul style="display: inline-block;">
				<?php
				
					echo '
						<ul style="display: inline-block;">
							<li style="list-style: none; text-align: center;"><img style="border: 1px solid grey; box-shadow: 3px 3px 3px grey;" src="' . $photo . '" alt="' . $nom . ' ' . $prenom . '" width="100" height="100"></li>

							<li style="list-style: none; text-align: center;">'.$nom .'</li>
							<li style="list-style: none; text-align: center;">'.$prenom .'</li>
						</ul> </ul> ';
			}
		}
		else
		{
			$nom = $e['nom_etu'];
				$prenom = $e['prenom_etu'];
				$photo = $e['photo'];
								?>
<ul style="display: inline-block;">
				<?php
					echo '
						<ul style="display: inline-block;">
							<li style="list-style: none; text-align: center;"><img style="border: 1px solid grey; box-shadow: 3px 3px 3px grey;" src="' . $photo . '" alt="' . $nom . ' ' . $prenom . '" width="100" height="100"></li>';
				echo '
						
							<li style="list-style: none; text-align: center;">'.$nom .'</li>
							<li style="list-style: none; text-align: center;">'.$prenom .'</li>
						</ul> </ul> ';
		}
	}
			echo'</div>
		</div>';


 
?>
</tr>
</table>
</div>
</div>
<table align="right">

<?php
 if(isset($_POST['groupe']) && $_POST['groupe'] != "Tous les groupes")
 { 
 	preg_match_all('#[0-9]+#', $_POST['groupe'] ,$matches);
 	echo'<td width="200"><a target="_blank" href="pdftrombi.php?groupe='.$matches[0][0].'" class="btn btn-danger">Exporter en PDF</a></td>';
 }
 else echo'<td width="200"><a target="_blank" href="pdftrombi.php" class="btn btn-danger">Exporter en PDF</a></td>';
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

