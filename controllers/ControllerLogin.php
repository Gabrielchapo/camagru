<?php
require_once('views/View.php');

class ControllerLogin
{
    private $_memberManager;
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
		$error = false;
		$login = htmlentities($_POST['login']);
		$password = htmlentities($_POST['password']);

		//check login
		if (!preg_match('/^[a-z\d_0-9]{8,20}$/i', $login))
		{
			$error = true;
			$errorMsg['login'] = "Incorrect login";
		}
		//check password
		if (!preg_match('/^[a-z\d_0-9]{8,20}$/i', $password))
		{
			$error = true;
			$errorMsg['password'] = "Incorrect password";
		}

		//if error occurs
		if ($error === true)
		{
			$this->_view = new View('Login');
        	$this->_view->generate(array('errorMsg' => $errorMsg));
		}
		else
		{
            header('Location: '. URL.'?url=Accueil');
            session_start();
            $_SESSION['login'] = $login;
            $this->_view = new View('Accueil');
            $this->_view->generate(array());
        }
	}
    private function loginView()
    {
        $this->_view = new View('Login');
        $this->_view->generate(array('info' => ""));
    }
}