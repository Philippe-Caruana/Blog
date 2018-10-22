<?php

namespace Projet8\Blog;

require_once('model/PostManager.php');

function listPosts()
{
	$postManager = new PostManager();

	$posts = $postManager->getPosts();

	require('view/frontend/listPostsView.php');
}