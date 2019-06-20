<?php
require_once('views/View.php');

class ControllerProfil
{
    private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->images();
    }

    private function images()
    {
		session_start();
        $this->_imageManager = new ImageManager;
        $images = $this->_imageManager->getMemberImages($_SESSION["id"]);

        $this->_view = new View('Accueil');
        $this->_view->generate(array('images' => $images));
    }
}