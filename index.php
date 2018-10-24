<?php

namespace Projet8\Blog;

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