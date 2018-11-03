<?php

namespace Projet8\Blog;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');
require_once('model/ReportManager.php');

function displayAuthentication() {
	require('view/backend/adminAuthenticationView.php');
}

function checkAdminCredentials() {
	if(isset($_POST['password']) && $_POST['password'] == "ADMIN") {

		// Permet de donner l'accès à l'interface pendant 30 min sans devoir retaper le mot de passe
		setcookie('adminAccess', '1', time() + 1800, null, null, false, true);

		header('Location: index.php?action=admin');
		
	}
	else {
		header('Location: index.php?action=administration&authentication=failed#authentication');
	}
}

function displayAdminView() {

	$adminView = true;
	$commentsPerPage = 5;
	$postsPerPage = 5;

	if(!isset($_GET['comment-page']))
	{
		$cCommentPage = 0;
	}
	else
	{
		$cCommentPage = (intval($_GET['comment-page']) - 1) * $commentsPerPage;
	}
	
	if(!isset($_GET['chapter-page']))
	{
		$cChapterPage = 0;
	}
	else
	{
		$cChapterPage = (intval($_GET['chapter-page']) - 1) * $postsPerPage;
	}

	$reportManager = new reportManager();
	$comments = $reportManager->getCommentsReport($commentsPerPage, $cCommentPage);
	
	$postManager = new postManager();
	$posts = $postManager->getAllPosts($postsPerPage, $cChapterPage);

	$nb_comments = $reportManager->countComments();
	$nb_posts = $postManager->countPosts();

	$nb_pages_comments = ceil($nb_comments / $commentsPerPage);
	
	$nb_pages_posts = ceil($nb_posts / $postsPerPage);

	require('view/backend/adminView.php');
}

function republishComment($commentId) {

	$commentManager = new CommentManager();

	$republishComment = $commentManager->republishComment($commentId);

	if($republishComment) {
		header('Location: index.php?action=admin&republish-comment=success');
	}
	else {
 		header('Location: index.php?action=admin&republish-comment=failed');
	}
}

function deleteComment($commentId) {

	$commentManager = new CommentManager();

	$deletedComment = $commentManager->deleteComment($commentId);

	if($deletedComment) {
		header('Location: index.php?action=admin&delete-comment=success');
	}
	else {
 		header('Location: index.php?action=admin&delete-comment=failed');
	}
}

function deletePost($postId) {

	$postManager = new PostManager();

	$deletedPost = $postManager->deletePost($postId);

	if($deletedPost) {
		header('Location: index.php?action=admin&delete-post=success#edit-articles-panel');
	}
	else {
 		header('Location: index.php?action=admin&delete-post=failed#edit-articles-panel');
	}
}

function publishPost($title, $content) 
{
	$postManager = new PostManager();

	$publishedPost = $postManager->publishPost($title, $content);

	if($publishedPost) {
		header('Location: index.php?action=admin&publish-post=success#create-articles-panel');
	}
	else {
 		header('Location: index.php?action=admin&publish-post=failed#create-articles-panel');
	}
}

function updatePost($postId, $title, $content) 
{
	$postManager = new PostManager();

	$updatedPost = $postManager->updatePost($postId, $title, $content);

	if($updatedPost) {
		header("Location: index.php?action=edit-post&id=$postId&update-post=success#chapter-content");
	}
	else {
 		header("Location: index.php?action=edit-post&id=$postId&update-post=failed#chapter-content");
	}
}