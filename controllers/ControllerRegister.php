<?php
require_once('views/View.php');

class ControllerRegister
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
		elseif ($_GET['submit'] === 'confirm')
			$this->emailConfirmed();
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
		if (strlen($password) >= 20)
		{
			$error = true;
			$errorMsg['login'] = "Login is too long (max 20 char)";
		}

		//check email address
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error = true;
			$errorMsg['email'] = "Incorrect email address";
		}
		if (strlen($email >= 100))
		{
			$error = true;
			$errorMsg['email'] = "Email is too long (max 100 char)";
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
		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8)
		{
			$error = true;
			$errorMsg['password'] = "Incorrect password (too weak)";
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

			$this->sendConfirmationMail($email, hash('whirlpool', $login));

			require_once('controllers/ControllerAccueil.php');
            $this->_ctrl = new ControllerAccueil(URL."Accueil");
		}
	}

	private function sendConfirmationMail($email, $hash_login)
	{
		$to  = $email;

		$subject = 'Confirmation mail';

		$message = '
					<html>
						<head>
							<title>Confirm your account</title>
						</head>
						<body>
							<a href="'. URL .'?url=register&submit=confirm&login='.$hash_login.'">Confirm your account Here</a>
						</body>
					</html>';

		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';

		mail($to, $subject, $message, implode("\r\n", $headers));
	}

	private function emailConfirmed()
	{
		require_once('controllers/ControllerAccueil.php');
		$this->_memberManager = new MemberManager;
		$members = $this->_memberManager->getAllMembers();

		foreach($members as $member):
			if (hash('whirlpool', $member->getLogin()) === $_GET['login'])
			{
				$this->_memberManager->confirmMembership($member->getLogin());
			}
		endforeach;

        $this->_ctrl = new ControllerAccueil(URL."Accueil");
	}
	
    private function registerView()
    {
		$this->_view = new View('Register');
        $this->_view->generate(array());
    }
}