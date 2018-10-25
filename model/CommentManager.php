<?php

namespace Projet8\Blog;

require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
    	$bdd = $this->dbConnect();

    	$comments = $bdd->prepare('SELECT id, posts_id, author, comment, DATE_FORMAT(comment_date, "%d/%m/%Y à %H:%i:%s") AS publish_date_fr FROM comments WHERE posts_id = ? ORDER BY comment_date DESC');

    	$comments->execute(array($postId));

    	return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
    	$bdd = $this->dbConnect();

    	$request = $bdd->prepare('INSERT INTO comments(posts_id, author, comment, comment_date) VALUES(:posts_id, :author, :comment, NOW())');
        
        $affectedLines = $request->execute(array(
        	'posts_id'	=>	$postId, 
        	'author'	=>	$author, 
        	'comment'	=>	$comment
        ));
        
        return $affectedLines;
    }
}