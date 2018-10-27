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
}