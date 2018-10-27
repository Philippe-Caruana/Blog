<?php

namespace Projet8\Blog;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');
require_once('model/ReportManager.php');

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
		$reportManager = new ReportManager();

		$comments = $commentManager->getComments($_GET['id']);

		if(!empty($_SESSION)) {
			$reportedCommentsId = $reportManager->getReportedCommentsId($_SESSION['id']);
		}

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

		$emailValidity = $memberManager->checkEmail($email);

		if ($usernameValidity) {
			header('Location: index.php?action=sign-up&error=username-already-used#registration');	
		}

		if ($emailValidity) {
			header('Location: index.php?action=sign-up&error=email-already-used#registration');
		}

		if (!$usernameValidity && !$emailValidity) {
			// On sécurise le mot de passe
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			
			$memberManager->createMember($username, $hashed_password, $email);
			
			// On connecte automatiquement la personne une fois son compte créé
			authentication($email, $password);

			// On affiche une notification à l'utilisateur en page d'accueil
			header('Location: index.php?account-status=account-successfully-created');
		}	
	} 
	else {
		header('Location: index.php?action=sign-up&error=google-recaptcha');
	}
}

function authentication($email, $password) {

	$memberManager = new MemberManager();
	
	$member = $memberManager->checkMemberCredentials($email);

	$isPasswordCorrect = password_verify($password, $member->password);

	if (!$member) {
        header('Location: index.php?action=login&account-status=authentication-failed#authentication');
    }
    else {
    	if ($isPasswordCorrect) {
    		$_SESSION['id'] = $member->id;
    		$_SESSION['username'] = ucfirst(strtolower($member->username));
    		$_SESSION['groups_id'] = $member->groups_id;

    		header('Location: index.php?sign-in=success');
    	}
        else {
        	header('Location: index.php?action=login&account-status=authentication-failed#authentication');
        }
    }
}

function signOut() {

	$_SESSION = array();

	setcookie(session_name(), '', time() - 42000);

	session_destroy();

	header('Location: index.php?sign-out=success');
}

function addComment($postId, $username, $comment) {
	
	$commentManager = new CommentManager();

	$affectedLines = $commentManager->postComment($postId, $username, $comment);

	if ($affectedLines === false) {
		throw new \Exception("Impossible d'ajouter le commentaire !");
	}
	else {
		header('Location: index.php?action=post&id=' . $postId . '#comments');
	}
}

function reportComment($postId, $commentId, $memberId) {
	
	$reportManager = new ReportManager();
	
	$reportManager->saveReport($commentId, $memberId);

	header('Location: index.php?action=post&id=' . $postId . '&report=success#comments');
}