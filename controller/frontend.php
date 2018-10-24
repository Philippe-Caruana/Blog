<?php

namespace Projet8\Blog;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');

function listPosts()
{
	$postManager = new PostManager();

	$posts = $postManager->getPosts();

	require('view/frontend/listPostsView.php');
}

function post()
{
	$postManager = new PostManager();

	$post = $postManager->getPost($_GET['id']);

	if($post) {

		$commentManager = new CommentManager();

		$comments = $commentManager->getComments($_GET['id']);

		require('view/frontend/postView.php');
	}
	else {
		header("Location: /index.php#chapters");
	}
}

function displayLogin() {

	require('view/frontend/loginView.php');
	
}

function displaySignUp() {

	$signUp = true;

	require('view/frontend/registrationView.php');

}

function addMember($username, $password, $email) {

	$memberManager = new MemberManager();

	$reCaptcha = $memberManager->getReCaptcha($_POST['g-recaptcha-response']);
	
	if ($reCaptcha->success == true) {

		$usernameValidity = $memberManager->checkUsername($username);

		$mailValidity = $memberManager->checkEmail($email);

		if ($usernameValidity) {
			header('Location: index.php?action=sign-up&error=username-already-used');	
		}

		if ($mailValidity) {
			header('Location: index.php?action=sign-up&error=email-already-used');
		}

		if (!$usernameValidity && !$mailValidity) {
			// On sécurise le mot de passe
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			
			$memberManager->createMember($username, $hashed_password, $email);
			
			// On affiche une notification à l'utilisateur en page d'accueil
			header('Location: index.php?account-status=account-successfully-created');
		}	
	} 
	else {
		header('Location: index.php?action=subscribe&error=google-recaptcha');
	}
}