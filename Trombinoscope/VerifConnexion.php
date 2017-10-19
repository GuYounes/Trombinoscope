<?php
if((!isset($_SESSION['adminConnected'])  && !isset($_SESSION['profConnected'])) || isset($_SESSION['userConnected'])) {
 // Deconnexion administrateur
	 header("location:ConnecAdmin.php");

}
?>