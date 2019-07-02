<?php
require_once('views/View.php');

class ControllerMontage
{
    private $_imageManager;
    private $_memberManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
        {
            $this->_memberManager = new MemberManager;
		    if ($this->_memberManager->getMemberconfirmation())
            {
                if ($_GET['submit'] === 'download')
                    $this->download_image();
                else if ($_GET['submit'] === 'delete')
                    $this->delete_img();
                $this->images();
            }
            else
                $this->ErrorNeedToConfirmEmail();
        }
    }

    private function ErrorNeedToConfirmEmail()
    {
        $this->_view = new View('Email');
        $this->_view->generate(array());
    }

    private function delete_img()
    {
        $this->_imageManager = new ImageManager;
        $this->_imageManager->deleteImage($_POST["id_image"]);
    }

    private function download_image()
    {
        session_start();
        $img = $_POST["img"];
        $this->_imageManager = new ImageManager;

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $dest = base64_decode($img);

        $adress = $this->_imageManager->getLast_id_plus_one().".png";
        $id_author = $_SESSION["id"];
        date_default_timezone_set('Europe/Paris');
        $date_creation = date("Y-m-d H:i:s");
        $date_creation = str_replace(' ', ':', $date_creation);

        file_put_contents("public/pictures/".$adress, $dest);
        $this->_imageManager->addImages($date_creation, $adress, $id_author);
    }

    private function images()
    {
		session_start();
        $this->_imageManager = new ImageManager;
        $images = $this->_imageManager->getMemberImages($_SESSION["id"]);

        $this->_view = new View('Montage');
        $this->_view->generate(array('images' => $images));
    }
}