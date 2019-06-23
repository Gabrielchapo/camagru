<?php
require_once('views/View.php');

class ControllerRegister
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
		//check password repeat
		if ($password !== $password_repeat)
		{
			$error = true;
			$errorMsg['password_repeat'] = "Incorrect password repeated";
		}

		//check password's strongness
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number = preg_match('@[0-9]@', $password);
		if(!$uppercase || !$lowercase || !$number || $special || strlen($password) < 10)
		{
			$error = true;
			$errorMsg['password'] = "Incorrect password";
		}
		//check if login already exists
		$this->_memberManager = new MemberManager;
		$members = $this->_memberManager->getAllMembers();
		foreach($members as $member)
		{
			if ($member->getLogin() === $login)
			{
				$error = true;
				$errorMsg['login'] = "Login already exists";
			}
		}
		//if error occurs
		if ($error === true)
		{
			$this->_view = new View('Register');
        	$this->_view->generate(array('errorMsg' => $errorMsg));
		}
		else
		{
			$id = $this->_memberManager->addMember($login, $email, hash('whirlpool', $password));
			session_start();
			$_SESSION['login'] = $login;
			$_SESSION['id'] = $id;
			$this->_imageManager = new ImageManager;
			$images = $this->_imageManager->getAllImages();
			$this->_view = new View('Accueil');
			$this->_view->generate(array('images' => $images));
		}
	}

    private function registerView()
    {
		$this->_view = new View('Register');
        $this->_view->generate(array());
    }
}