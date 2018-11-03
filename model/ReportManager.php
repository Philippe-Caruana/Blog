<?php

namespace Projet8\Blog;

require_once('model/Manager.php');

class ReportManager extends Manager 
{
	public function getReportedCommentsId($memberId) {
		
		$bdd = $this->dbConnect();
		
		$request = $bdd->prepare('SELECT comments_id FROM reports WHERE members_id = ?');
		
		$request->execute(array($memberId));
		
		$reports = $request->fetchAll(\PDO::FETCH_ASSOC);

		$reportedCommentsId = array();

		foreach ($reports as $value) {
			$reportedCommentsId[] = $value['comments_id'];
		}
        
        return $reportedCommentsId;
    }

    public function saveReport($commentId, $memberId) {
    	
    	$bdd = $this->dbConnect();
    	
    	$request = $bdd->prepare('INSERT INTO reports(comments_id, members_id, report_date) VALUES(:comments_id, :members_id, NOW())');
    	
    	$request->execute(array(
    		'comments_id'	=>	$commentId, 
    		'members_id'	=>	$memberId
    	));
    }

    public function getCommentsReport($commentsPerPage, $currentPage) 
    {
        $bdd = $this->dbConnect();

        //$requete = $bdd->exec('SELECT COUNT(comment_id) AS nb_report FROM reports GROUP BY comment_id DESC');

        $comments = $bdd->prepare("
            SELECT COUNT(comments_id) AS nb_report, comments.id, posts_id, username, comment, DATE_FORMAT(comment_date, '%d/%m/%Y %H:%i:%s') AS date_fra 
            FROM reports 
            INNER JOIN comments
            ON reports.comments_id = comments.id
            INNER JOIN members
            ON comments.members_id = members.id
            GROUP BY comments_id 
            HAVING nb_report >= 3
            ORDER BY nb_report DESC
            LIMIT :commentsPerPage OFFSET :currentPage
        ");
        
        $comments->bindParam(':commentsPerPage', $commentsPerPage, \PDO::PARAM_INT);
        $comments->bindParam(':currentPage', $currentPage, \PDO::PARAM_INT);

        $comments->execute();
        
        return $comments->fetchAll();
    }

    public function countComments()
    {
        $bdd = $this->dbConnect();

        $req = $bdd->query('
            SELECT COUNT(id) AS nb_report
            FROM reports 
            GROUP BY comments_id 
            HAVING nb_report >= 3
            ORDER BY nb_report DESC
        ');

        $nb_comments = $req->fetchAll();

        return count($nb_comments);
    }
}