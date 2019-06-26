<?php
require_once('views/View.php');

class ControllerMontage
{
    private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else if ($_GET['submit'] === 'download')
            $this->download_image();
        $this->images();
    }

    private function download_image()
    {
        $img = $_POST["img"];

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $dest = base64_decode($img);
        file_put_contents("public/pictures/tmp.png", $dest);
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