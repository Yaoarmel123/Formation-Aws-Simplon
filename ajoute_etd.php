<?php
// I . Récupération des données du formulaire ajout étudiant
echo '<h4> Récapitulatif des données saisies</h4>';
//Récupuération du nom saisi
$Nom=htmlentities($_POST['Nom']);
//echo 'Nom : '.$nom.'<br>';
//Récupuération du prénom saisi
$Prénom=htmlentities($_POST['Prénom']);
//echo 'Prénom : '.$prenoms.'<br>';
//Récupuération du Numéro choisi
$Numéro=htmlentities($_POST['Numéro']);
//echo 'Numéro : '.$Numéro.'<br>';
//Récupuération du mail saisi
$mail=htmlentities($_POST['email']);
//echo 'E-mail : '.$mail.'<br>';

// II. Connexion au serveur
// 1. Définir les paramètres de connexion
$PARAM_hote='localhost'; // Nom ou adresse du serveur où se trouve la base de données
$PARAM_nom_bd='bd_etudiants'; // Nom de la base de données
$PARAM_utilisateur='root'; // Nom de l'utilisateur qui se connecte
$PARAM_mot_passe=''; // Mot de passe de l'utilisateur
$PARAM_charset='utf8'; // Jeu de caractère

// 2. Creation de la connexion
try
{
	$bdd= new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd.';charset='.
	$PARAM_charset, $PARAM_utilisateur, $PARAM_mot_passe);
}
catch(Exception $e)
{
die('Erreur de connexion à la base de données : <br>'.$e->getMessage().'<br>');
}

//III. Insertion des données
//1. On défini la reqête (on la mets dans un variable pour faciliter la manipulation)
$req="INSERT INTO etudiants(Nom,
Prénom,Numéro,Adresse email) VALUES(:Nom,
:Prénom,:Numéro,:Adresse email)" ;

//2. On demande au système de préparer la requête ($bdd est le nom de la connexion à BD
$ajout_etd= $bdd->prepare($req);

try {
//3. On donne la valeur de chaque marqueur
$ajout_etd->bindValue(':Nom',$nom);
$ajout_etd->bindValue(':Prénom',$prenoms);
$ajout_etd->bindValue(':Numéro',$Numéro);
$ajout_etd->bindValue(':Adresse email',$mail);

//4. Exécution de la requête
$resultat = $ajout_etd->execute();

//5. Si la requete est bien exécutée
if($resultat){
	echo 'Enregistrement réussi <br />';
	echo '<a href="etudiant.php">Retour / Ajouter un autre étudiant </a>';
	}
}

//6. S'il y a eu des erreurs
catch( Exception $e ){
	echo 'Erreur de requête : ', $e->getMessage();
}
?>