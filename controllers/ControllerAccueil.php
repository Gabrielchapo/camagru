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
            if (!$_GET["nb"])
                $page = 0;
            else
                $page = $_GET["nb"];
            if ($_GET['submit'] === 'logout')
                $this->logout();
            else if ($_GET['submit'] === 'delete_account')
                $this->delete_account();
            else if ($_GET['submit'] === 'malus')
                $page -= 1;
            else if ($_GET['submit'] === 'plus')
                $page += 1;
            $this->images($page);
        }
    }


    private function images($page)
    {
        $this->_imageManager = new ImageManager;
        $images = $this->_imageManager->getAllImages();
        $nb_images = $this->_imageManager->getNbImages();
        $this->_view = new View('Accueil');
        $this->_view->generate(array(
            'images' => $images,
            'page' => $page,
            'nb_images' => $nb_images,
        ));
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