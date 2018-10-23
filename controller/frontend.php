<?php

namespace Projet8\Blog;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

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