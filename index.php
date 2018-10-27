<?php

namespace Projet8\Blog;

session_start();

require('controller/frontend.php');

try{
	if(isset($_GET['action'])) {
		if ($_GET['action'] == "post") {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				post();
			}
			else {
				header("Location: /index.php#chapters");
			}
		}
		elseif ($_GET['action'] == "login") {
			displayLogin();
		}
		elseif ($_GET['action'] == "sign-up") {
			displaySignUp();
		}
		elseif ($_GET['action'] == 'addMember') {
			
			if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirmation'])) {

				if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

					if ($_POST['password'] == $_POST['passwordConfirmation']) {

						addMember(strip_tags($_POST['username']), strip_tags($_POST['password']), strip_tags($_POST['email']));
					}
					else {
						header("Location: /index.php?action=sign-up&error=different-passwords");
					}
				} 
				else {

					throw new \Exception("L'adresse email que vous avez renseigné ne dispose pas d'un format valide.");
				}
			} 
			else {

				throw new \Exception("Vous devez renseigner tous les champs.");
			}
		}
		elseif ($_GET['action'] == "authentication") {

			authentication(strip_tags($_POST['email']), strip_tags($_POST['password']));
		}
		elseif ($_GET['action'] == "sign-out") {

			signOut();
		}
		elseif ($_GET['action'] == 'addComment') {
			if (isset($_GET['id']) && $_GET['id'] > 0) {

        		if (!empty($_SESSION['id']) && !empty($_POST['comment'])) {

            		addComment($_GET['id'], $_SESSION['id'], $_POST['comment']);
        		}
        		else {

            		throw new \Exception('Tous les champs ne sont pas remplis !');
        		}
    		}else {

        		throw new \Exception('Aucun identifiant de billet envoyé');
    		}
    	}
    	elseif ($_GET['action'] == 'report') {

			reportComment($_GET['id'], $_GET['comment-id'], $_SESSION['id']);

		}
		else {
			header("Location: /");
		}
	}
	else {
		listPosts();
	}
}
catch(\Exception $e){
	echo 'Erreur : ' . $e->getMessage();
}