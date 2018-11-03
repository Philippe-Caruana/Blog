<?php

namespace Projet8\Blog;

require_once('model/Manager.php');

class PostManager extends Manager
{
	public function getPosts()
	{
	    $db = $this->dbConnect();
	    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 6');
	    
	    return $req;
	}

	public function getPost($postId)
	{
	    $db = $this->dbConnect();
	    $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts WHERE id = ?');
	    $req->execute(array($postId));
	    $post = $req->fetch();

	    return $post;
	}

	public function getAllPosts($postsPerPage, $currentPage)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, title, DATE_FORMAT(creation_date, "%d/%m/%Y %H:%i:%s") AS publish_date FROM posts ORDER BY creation_date DESC LIMIT :postsPerPage OFFSET :currentPage');

        $req->bindParam('postsPerPage', $postsPerPage, \PDO::PARAM_INT);
        $req->bindParam('currentPage', $currentPage, \PDO::PARAM_INT);

        $req->execute();
        
        return $req;
    }

    public function countPosts()
    {
        $bdd = $this->dbConnect();

        $req = $bdd->query('SELECT COUNT(id) AS nb_posts FROM posts');

        $nb_posts = $req->fetch();

        return $nb_posts->nb_posts;
    }

    public function getMoreChapters($chaptersPerPage, $startChaptersAt) 
    {
    	$bdd = $this->dbConnect();

    	$request = $bdd->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT :nb_chapters OFFSET :start');

    	$request->bindParam(':nb_chapters', $chaptersPerPage, \PDO::PARAM_INT);
	    $request->bindParam(':start', $startChaptersAt, \PDO::PARAM_INT);

	    $request->execute();

	    $chapters = $request->fetchAll(\PDO::FETCH_ASSOC);

	    $request->closeCursor();

	    return $chapters;
    }

    public function deletePost($postId)
    {
    	$bdd = $this->dbConnect();

    	$request = $bdd->prepare('DELETE FROM posts WHERE id = ?');

    	$deletedPost = $request->execute(array($postId));

    	return $deletedPost;
    }

    public function publishPost($title, $content) 
    {
    	$bdd = $this->dbConnect();

    	$request = $bdd->prepare('INSERT INTO posts (id, title, content, creation_date, update_date) VALUES (id, :title, :content, NOW(), NOW())');

    	$publishedPost = $request->execute(array(
    		'title'		=>	$title,
    		'content'	=>	$content
    	));

    	return $publishedPost;
    }

    public function updatePost($postId, $title, $content)
    {
    	$bdd = $this->dbConnect();

    	$request = $bdd->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :postId');

    	$updatedPost = $request->execute(array(
    		'title'		=>	$title,
    		'content'	=>	$content,
    		'postId'	=>	$postId
    	));

    	return $updatedPost;
    }
}