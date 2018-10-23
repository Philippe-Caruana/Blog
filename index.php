<?php

namespace Projet8\Blog;

require('controller/frontend.php');

try{
	if(isset($_GET['action'])) {
		if($_GET['action'] == "post") {
			if(isset($_GET['id']) && $_GET['id'] > 0) {
				post();
			}
			else {
				header("Location: /index.php#chapters");
			}
		}
		else if($_GET['action'] == "login") {
			displayLogin();
		}
	}
	else {
		listPosts();
	}
}
catch(Exception $e){
	echo 'Erreur : ' . $e->getMessage();
}