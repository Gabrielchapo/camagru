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
		elseif ($_GET['submit'] === 'ok') { $this->checkForm(); }
        else { $this->registerView(); }
    }


	private function checkForm()
	{
		$login = $_POST['login'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_repeat = $_POST['password_repeat'];
		if (!preg_match('/^[a-z\d_]{2,20}$/i', $login))
		{
			$error = "pas bien tout ca";
			echo $error;
			$this->_view = new View('Register');
        	$this->_view->generate(array('error' => $error));
		}
	}

    private function registerView()
    {
		$this->_view = new View('Register');
        $this->_view->generate(array());
    }
}