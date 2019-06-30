<?php
require_once('views/View.php');

class ControllerLogin
{
	private $_ctrl;
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
		
		if ($member["password"] !== hash('whirlpool', $password))
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
			require_once('controllers/ControllerAccueil.php');
            $this->_ctrl = new ControllerAccueil(URL."Accueil");
        }
	}
    private function loginView()
    {
        $this->_view = new View('Login');
        $this->_view->generate(array('info' => ""));
    }
}