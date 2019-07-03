<?php
require_once('views/View.php');

class ControllerReset
{
	private $_memberManager;
    private $_view;
    private $_ctrl;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else if ($_GET['submit'] === 'reset')
            $this->sendEmail();
        else if ($_GET['submit'] === 'change')
            $this->changeView(array('info' => ""));
        else if ($_GET['submit'] === 'confirm')
            $this->changePassword();
        else
            $this->resetView(array('info' => ""));
    }

    private function resetView($array)
    {
        $this->_view = new View('Reset');
        $this->_view->generate($array);
    }

    private function changeView($errorMsg)
    {
        $this->_memberManager = new MemberManager;
        $id = $this->_memberManager->checkToken($_GET['token']);
        if ($id)
        {
            $this->_view = new View('Change');
            $errorMsg['token'] = $_GET['token'];
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
        else {
            $this->_view = new View('Reset');
            $this->_view->generate(array('info' => "Wrong token"));
        }
    }

    private function kodex_random_string($length=200){
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for($i=0; $i<$length; $i++){
            $string .= $chars[rand(0, strlen($chars)-1)];
        }
        return $string;
    }
    private function changePassword()
    {
        $password = htmlentities($_POST['password']);
        $password_repeat = htmlentities($_POST['password_repeat']);
        $error = false;
        
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
        /*if ($error = true)
            $this->changeView($errorMsg);
        else
        {*/
            $this->_memberManager = new MemberManager;
            $id = $this->_memberManager->checkToken($_GET['token']);
            $this->_memberManager->resetPassword($id, $password);
			require_once('controllers/ControllerLogin.php');
            $this->_ctrl = new ControllerLogin(URL."Login");
        //}
    }
    
    private function sendEmail()
    {
        $existing = false;
        $this->_memberManager = new MemberManager;
        $members = $this->_memberManager->getAllMembers();
		foreach($members as $member)
		{
            if ($member->getLogin() === $_POST['login'])
            {
                $existing = true;
                $email = $member->getEmail();
                $login = $member->getLogin();
            }
		}
        if ($existing)
        {
            $token = $this->kodex_random_string();
            $this->_memberManager->addToken($token, $login);
            $to  = $email;

            $subject = 'Reset mail';

            $message = '
                        <html>
                            <head>
                                <title>Reset your password</title>
                            </head>
                            <body>
                                <a href="'. URL .'?url=reset&submit=change&token='.$token.'">Click Here</a>
                            </body>
                        </html>';

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            mail($to, $subject, $message, implode("\r\n", $headers));

            $this->resetView(array('info' => "Email has been sent"));
        }
        else
            $this->resetView(array('info' => "Member doesn't exist"));
    }
}