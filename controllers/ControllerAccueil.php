<?php
require_once('views/View.php');

class ControllerAccueil
{
    private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
        {
            if ($_GET['submit'] === 'logout')
                $this->logout();
            if ($_GET['submit'] === 'delete_account')
			    $this->delete_account();
            $this->images();
        }
    }

    private function images()
    {
        $this->_imageManager = new ImageManager;
        $images = $this->_imageManager->getAllImages();

        $this->_view = new View('Accueil');
        $this->_view->generate(array('images' => $images));
    }

    private function logout()
    {
        session_start();
        $_SESSION['login'] = null;
    }

    private function delete_account()
    {
        
    }
}