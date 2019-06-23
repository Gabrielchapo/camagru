<?php
require_once('views/View.php');

class ControllerLogin
{
	private $_memberManager;
	private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        elseif ($_GET['submit'] === 'ok')
			$this->checkForm();
        else
            $this->loginView();
    }

    private function checkForm()
	{
		$login = htmlentities($_POST['login']);
		$password = htmlentities($_POST['password']);

		//check login && password
		$this->_memberManager = new MemberManager;
		$member = $this->_memberManager->getMemberPassword($login);
		
		if (!$member["password"] || $member["password"] !== $password)
		{
			$errorMsg = "Incorrect login or password";
			$this->_view = new View('Login');
        	$this->_view->generate(array('errorMsg' => $errorMsg));
		}
		else
		{
			session_start();
			$_SESSION['login'] = $login;
			$_SESSION['id'] = $member["id_member"];
			$this->_imageManager = new ImageManager;
			$images = $this->_imageManager->getAllImages();
			$this->_view = new View('Accueil');
			$this->_view->generate(array('images' => $images));
        }
	}
    private function loginView()
    {
        $this->_view = new View('Login');
        $this->_view->generate(array('info' => ""));
    }
}