<?php
require_once('views/View.php');

class ControllerRegister
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
			$this->registerView();
    }


	private function checkForm()
	{
		$error = false;
		$login = htmlentities($_POST['login']);
		$email = htmlentities($_POST['email']);
		$password = htmlentities($_POST['password']);
		$password_repeat = htmlentities($_POST['password_repeat']);

		//check login
		if (!preg_match('/^[a-z\d_0-9]{8,20}$/i', $login))
		{
			$error = true;
			$errorMsg['login'] = "Incorrect login";
		}
		//check email adress
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error = true;
			$errorMsg['email'] = "Incorrect email adress";
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
			$this->_view = new View('Register');
        	$this->_view->generate(array('errorMsg' => $errorMsg));
		}
		else
		{
			$this->_memberManager = new MemberManager;
			$this->_memberManager->addMember($login, $email, $password);
			$this->_view = new View('Login');
			$this->_view->generate(array('info' => "You will receive a mail !"));
		}
	}

    private function registerView()
    {
		$this->_view = new View('Register');
        $this->_view->generate(array());
    }
}