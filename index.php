<?php
//CONTROLLER DE LA PAGE D'ACCUEIL
//Demarrage de la session :
session_start();

//Declaration des variables d'affichage :
$message = "";
$list = "";

//import des modèles :

include "./utils/utils.php";
include "./model/model_players.php";
include "./view/view_home.php";


//Création d'un l'objet de connexion et d'un objet Players et de l'obje ViewHome pour les messages d'erreur et la liste des joueurs:
$bdd = new PDO('mysql:host=localhost;dbname=supergame','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$home = new ViewHome();

//Vérifier que l'on reçoit le formulaire d'inscription:
if(isset($_POST["submit"])){

    //Vérifier les champs vides:
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) &&!empty($_POST['score']) && !empty($_POST['password']) && !empty($_POST['passwordVerify']) ){
        
        // Vérifier le format des données:

        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

            //Nettoyage des données
        
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
            $passwordVerify = sanitize($_POST['passwordVerify']);
            $score = $_POST['score'];

            //Vérifier la correspondance des mots de passe:

            if($password === $passwordVerify){
                //Hasher le mot de passe:

                $password = password_hash($password, PASSWORD_DEFAULT);
                $player = new Players($bdd, $pseudo,$email, $score, $password);
                //Envoyer une requête SELECT pour verifier si l'adresse mail n'est pas déja utilisée :
                
                $data = $player->getPlayerByMail();

                //Vérification si $data est vide:
                if(empty($data)){

                    //$data vide -> email dispo, requête d'inscription:
                    
                    $data = $player->addPlayer();

                    //Affichage du message de confirmation:
                    $home->setMessage($data['message']);
                    
                }else{              
                    //message d'erreur:
                    $home->setMessage('Pseudo ou Email indisponible.');
                }
                

            }else{
                //message d'erreur:
               $home->setMessage("Vos mots de passe ne sont pas identiques");
            }

        }else{
            //message d'erreur:
            $home->setMessage("Veuillez entrer un email valide");
        }

    }else{
        //message d'erreur:
        $home->setMessage("Veuillez remplir tous les champs");
    }
}



//Creation de l'objet players pour l'affichage de la liste:
$player = new Players($bdd);
$listPlayers = $player->getPlayers();


//Boucle pour générer un affichage des joueurs:
foreach($listPlayers as $players){
    $list = $list."<article>
        <h3> {$players['pseudo']} </h3>
        <p> {$players['email']} </p>
        <p> {$players['score']}</p><hr/>
    </article>";
}
$home->setList(($list));

//Import des vues:
include "./view/header.php";
$header = new Header();
$header->setContent("Accueil");
echo $header->renderHeader();
echo $home->renderHome();
include "./view/footer.php";
$header = new Footer();
$header->setContent("Ceci est un footer");
echo $header->renderFooter();

?>