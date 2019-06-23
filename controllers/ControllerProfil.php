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
		    {
			    $error = true;
                $errorMsg['login'] = "Incorrect login";
            }
            else
            {
                $this->_memberManager->modifyLogin($login);
                $_SESSION["login"] = $login;
                $errorMsg['login'] = "Login has been modified";
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