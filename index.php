<?php

namespace Projet8\Blog;

require('controller/frontend.php');

try{
	listPosts();
}
catch(Exception $e){
	echo 'Erreur : ' . $e->getMessage();
}