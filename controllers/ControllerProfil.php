<?php
require_once('views/View.php');

class ControllerProfil
{
    private $_memberManager;
    private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        elseif ($_GET['submit'] === 'modify')
        {
            $this->modifyMember();
        }
        elseif ($_GET['submit'] === 'delete')
        {
            $this->deleteMember();
            $this->_imageManager = new ImageManager;
			$images = $this->_imageManager->getAllImages();
			$this->_view = new View('Accueil');
			$this->_view->generate(array('images' => $images));
        }
        elseif ($_GET['submit'] === 'activate')
        {
            $this->_memberManager = new MemberManager;
            $this->_memberManager->activateComment();
        }
        elseif ($_GET['submit'] === 'desactivate')
        {
            $this->_memberManager = new MemberManager;
            $this->_memberManager->desactivateComment();
        }
        else
        {
            $this->_view = new View('Profil');
            $this->_view->generate(array());
        }
    }

    private function modifyMember()
    {
        $this->_memberManager = new MemberManager;
        //Check login
        if (isset($_POST['login']))
        {
            $login = htmlentities($_POST['login']);
            if (!preg_match('/^[a-z\d_0-9]{8,20}$/i', $login))
                $errorMsg['login'] = "Incorrect login";
            else
            {
                $this->_memberManager->modifyLogin($login);
                $_SESSION["login"] = $login;
                $errorMsg['login'] = "Login has been modified";
            }
        }

        //Check email
        if (isset($_POST['email']) != "")
        {
            $email = htmlentities($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                $errorMsg['email'] = "Incorrect email adress";
            else
            {
                $this->_memberManager->modifyEmail($email);
                $errorMsg['email'] = "Email has been modified";
            }
        }

        //Check password
        if (isset($_POST['password']) && isset($_POST['password_repeat']))
        {
            //check password's strongness
		    $uppercase = preg_match('@[A-Z]@', $_POST['password']);
		    $lowercase = preg_match('@[a-z]@', $_POST['password']);
		    $number = preg_match('@[0-9]@', $_POST['password']);
		    if(!$uppercase || !$lowercase || !$number || strlen($_POST['password']) < 10)
			    $errorMsg['password'] = "Incorrect password (too weak)";
            else if ($_POST['password'] !== $_POST['password_repeat'])
                $errorMsg['password_repeat'] = "Passwords don't match";
            else
            {
                $this->_memberManager->modifyPassword(hash('whirlpool', $_POST['password']));
                $errorMsg['password'] = "Password has been modified";
            }
        }
        //print view
        $this->_view = new View('Profil');
        $this->_view->generate(array('errorMsg' => $errorMsg));
    }

    private function deleteMember()
    {
        session_start();
        $this->_memberManager = new MemberManager;
        $this->_memberManager->deleteMember($_SESSION["id"]);
        $_SESSION["id"] = null;
        $_SESSION["login"] = null;
    }
}