<?php

function generer_mot_de_passe()
{
        $nb_caractere = 12;
        $mot_de_passe = "";
       
        $chaine = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ0123456789+@!$%?&";
        $longeur_chaine = strlen($chaine);
       
        for($i = 1; $i <= $nb_caractere; $i++)
        {
            $place_aleatoire = mt_rand(0,($longeur_chaine-1));
            $mot_de_passe = $mot_de_passe.$chaine[$place_aleatoire];
        }
        
        return $mot_de_passe;  
}

?>

