<?php
require_once('views/View.php');

class ControllerProfil
{
    private $_memberManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->get_view();
    }

    private function get_view()
    {
        $this->_view = new View('Profil');
        $this->_view->generate(array());
    }
}