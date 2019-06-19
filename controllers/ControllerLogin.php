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
        else
        {
            $this->members();
        }
    }

    private function members()
    {
        $this->_memberManager = new MemberManager;
        $members = $this->_memberManager->getMembers();

        $this->_view = new View('Login');
        $this->_view->generate(array('members' => $members));
    }
}