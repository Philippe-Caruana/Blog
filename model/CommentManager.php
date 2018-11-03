<?php

namespace Projet8\Blog;

require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $bdd = $this->dbConnect();

        $comments = $bdd->prepare('
            SELECT comments.id, posts_id, username, comment, groups_id, DATE_FORMAT(comment_date, "%d/%m/%Y à %H:%i:%s") AS publish_date_fr 
            FROM comments 
            INNER JOIN members 
            ON comments.members_id = members.id 
            WHERE posts_id = ? 
            AND comments.id 
            NOT IN (
                SELECT comments_id 
                FROM reports 
                GROUP BY comments_id 
                HAVING COUNT(comments_id) >= 3
            )
            ORDER BY comment_date 
            DESC
            
        ');

        $comments->execute(array($postId));

        return $comments;
    }
    
    public function postComment($postId, $memberId, $comment)
    {
    	$bdd = $this->dbConnect();

    	$request = $bdd->prepare('INSERT INTO comments(posts_id, members_id, comment, comment_date) VALUES(:posts_id, :members_id, :comment, NOW())');
        
        $affectedLines = $request->execute(array(
        	'posts_id'     =>	$postId, 
        	'members_id'   =>	$memberId, 
        	'comment'      =>	$comment
        ));
        
        return $affectedLines;
    }

    public function republishComment($commentId) 
    {
        $bdd = $this->dbConnect();

        $request = $bdd->prepare('DELETE FROM reports WHERE comments_id = ?');

        $affectedLines = $request->execute(array($commentId));

        return $affectedLines;
    }

    public function deleteComment($commentId) 
    {
        $bdd = $this->dbConnect();

        $request = $bdd->prepare('DELETE FROM comments WHERE id = ?');

        $deletedComment = $request->execute(array($commentId));

        return $deletedComment;
    }
}