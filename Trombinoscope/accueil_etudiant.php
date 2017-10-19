<?php
include("header/menu_etud.html");

$id_etu=$_GET['id_etu'];
require_once('connexion_bdd.php');
$ps=$bdd->prepare("SELECT * FROM etudiant WHERE id_etu=?");
$params=array($id_etu);
$ps->execute($params);
//fetch recupere la ligne
$etudiant=$ps->fetch();
$image=$etudiant['photo'];
session_start();
if(!isset($_SESSION['userConnected']) || isset($_SESSION['adminConnected'])){
 // Deconnexion administrateur
 header("location:ConnecAdmin.php");
}

	echo '<div class="container">
      <div class="jumbotron" align="center">

    <img src="'.$image.'" width="100" height="100"><br> 

        <h1>Téléchargez votre photo</h1>
        
        <p>
		<form method="post" enctype="multipart/form-data">
          
		  <input type="file" name="photo" class="form_control"></br></br>
    <input type="submit">
	      </p>
      
</form>
        </p>
      </div>

    </div> ' ;

if(isset($_FILES['photo']['name'])){

$nomPhoto=$_FILES['photo']['name'];
$fichierTempo=$_FILES['photo']['tmp_name'];
require_once("connexion_bdd.php");

/*$ps=$bdd->prepare("INSERT INTO etudiants(PHOTO) VALUES(?)");
$params=array($nomPhoto);
$ps->execute($params);*/
$imageFileType = pathinfo($nomPhoto,PATHINFO_EXTENSION);

$uploadOk = 1;
// Test si c'est vraiment une image

// test si le fichier existe déjà
if (file_exists($nomPhoto)) {
    echo "Le fichier existe déjà.";
    $uploadOk = 0;
}
// Taille de l'image
if (empty($nomPhoto)) {
    echo "Désolé le fichier est vide.";
    $uploadOk = 0;
}
// Verif de l'extension de l'mage
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Seules les images de type JPEG, GIF, PNG et JPG sont autorisées.";
    $uploadOk = 0;
}
// SI l'mage a bien été téléchargé
if ($uploadOk == 0) {
    echo "Le fichier n'a pas été uploader.";
// tout est ok
} else {

    if(move_uploaded_file($_FILES['photo']['tmp_name'], 'images/Photo'.$id_etu.'.'.pathinfo($nomPhoto,PATHINFO_EXTENSION))){

        $image = 'images/Photo'.$id_etu.'.'.$imageFileType;
        $ps=$bdd->prepare('UPDATE etudiant SET photo = ? WHERE id_etu=?');
        $params=array($image,$id_etu);
        $ps->execute($params);
        echo "Votre image a bien été téléchargée.";

    } else {
        echo "Une erreur s'est produite.";
    }

    header('Location:accueil_etudiant.php?id_etu='.$id_etu);

}
}
?>