<?php

namespace Projet8\Blog;

require_once("model/Manager.php");

class MemberManager extends Manager
{
    public function checkMemberCredentials($email)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, groups_id, username, password FROM members WHERE email = ?');
        $req->execute(array($email));
        $member = $req->fetch();

        return $member;
    }

    public function checkUsername($username) 
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT username FROM members WHERE username = ?');
        $req->execute(array($username));
        $usernameValidity = $req->fetch();

		return $usernameValidity;
	}

	public function checkEmail($email) 
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT email FROM members WHERE email = ?');
        $req->execute(array($email));
		$emailValidity = $req->fetch();

		return $emailValidity;
	}

    public function createMember($username, $password, $email)
    {
        $bdd = $this->dbConnect();
        $newMember = $bdd->prepare('INSERT INTO members(groups_id, username, password, email, registration_date) VALUES (2, :username, :password, :email, NOW())');
        $newMember->execute(array(
            'username'  =>  $username, 
            'password'  =>  $password, 
            'email'     =>  $email
        ));
    }

    public function getSecretKey() 
    {
        $secretKey = 'Your Secret Key';

        return $secretKey;
    }

    public function getReCaptcha($token) 
    {
        $secretKey = $this->getSecretKey();
        $request = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $token . '');
        $response = json_decode($request);

        return $response;
    }
}