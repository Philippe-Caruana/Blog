<?php

namespace Projet8\Blog;

session_start();

require('controller/frontend.php');
require('controller/backend.php');

try{
	if(isset($_GET['action'])) {
		if ($_GET['action'] == "post") {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				post($_GET['id']);
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
    		if(!empty($_SESSION)) {
				if(isset($_GET['id']) && $_GET['id'] > 0) {
					if(isset($_GET['comment-id']) && $_GET['comment-id']) {
						reportComment($_GET['id'], $_GET['comment-id'], $_SESSION['id']);
					}
				}
			}
		}
		elseif ($_GET['action'] == 'administration') {
			if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
				displayAuthentication();
			}
			else {
				header("Location: /");
			}
		}
		elseif ($_GET['action'] == 'sign-in-administration') {
			if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
				checkAdminCredentials();
			}
			else {
				header("Location: /");
			}
		}
		elseif ($_GET['action'] == 'admin') {
			if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
				if($_COOKIE['adminAccess'] == '1') {
					displayAdminView();
				}
				else {
					header('Location: index.php?action=administration');
				}
			}
			else {
				header("Location: /");
			}
		}
		elseif ($_GET['action'] == 'load-more-content') {
			if(isset($_GET['page']) && $_GET['page'] > 0) {
				loadMoreChapters($_GET['page']);
			}
			else {
				header("Location: /");
			}
		}
		elseif ($_GET['action'] == 'republish-comment') {
			if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
				if(isset($_GET['id']) && $_GET['id'] > 0) {
					if($_COOKIE['adminAccess'] == '1') {
						republishComment($_GET['id']);
					}
					else {
						header('Location: index.php?action=administration');
					}
				}
				else {
					throw new \Exception("Aucun identifiant de commentaire n'a été envoyé");
				}
			}
			else {
				header("Location: /");
			}
		}
		elseif ($_GET['action'] == 'delete-comment') {
			if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
				if(isset($_GET['id']) && $_GET['id'] > 0) {
					if($_COOKIE['adminAccess'] == '1') {
						deleteComment($_GET['id']);
					}
					else {
						header('Location: index.php?action=administration');
					}
				}
				else {
					throw new \Exception("Aucun identifiant de commentaire n'a été envoyé");
				}
			}
			else {
				header("Location: /");
			}
		}
		elseif ($_GET['action'] == 'delete-post') {
			if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
				if(isset($_GET['id']) && $_GET['id'] > 0) {
					if($_COOKIE['adminAccess'] == '1') {
						deletePost($_GET['id']);
					}
					else {
						header('Location: index.php?action=administration');
					}
				}
				else {
					throw new \Exception("Aucun identifiant d'article n'a été envoyé");
				}
			}
			else {
				header("Location: /");
			}
		}
		elseif ($_GET['action'] == 'edit-post') {
			if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
				if(isset($_GET['id']) && $_GET['id'] > 0) {
					if($_COOKIE['adminAccess'] == '1') {
						post($_GET['id']);
					}
					else {
						header('Location: index.php?action=administration');
					}
				}
				else {
					throw new \Exception("Aucun identifiant d'article n'a été envoyé");
				}
			}
			else {
				header("Location: /");
			}
		}
		elseif ($_GET['action'] == 'publish-post') {
			if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
				if($_COOKIE['adminAccess'] == '1') {
					if(!empty($_POST["title"]) && !empty($_POST["content"])) {
						publishPost($_POST["title"], $_POST["content"]);
					}
					else {
						header('Location: index.php?action=admin&empty-fields=true#create-articles-panel');
					}
				}
				else {
					header('Location: index.php?action=administration');
				}
			}
			else {
				header("Location: /");
			}
		}
		elseif ($_GET['action'] == 'update-post') {
			if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
				if($_COOKIE['adminAccess'] == '1') {
					if(isset($_GET['id']) && $_GET['id'] > 0) {
						if(!empty($_POST["title"]) && !empty($_POST["content"])) {
							updatePost($_GET['id'], $_POST["title"], $_POST["content"]);
						}
						else {
							throw new \Exception("Vous devez renseigner tous les champs");
						}
					}
					else {
						throw new \Exception("Aucun identifiant d'article n'a été envoyé");
					}
				}
				else {
					header('Location: index.php?action=administration');
				}
			}
			else {
				header("Location: /");
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