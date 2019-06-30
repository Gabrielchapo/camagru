<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/views/View.php';

class ControllerAccueil
{
    private $_imageManager;
    private $_likeManager;
    private $_commentManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
        {
            if ($_POST["submit"] === "like")
            {
                $this->_likeManager = new LikeManager;
                echo $_POST["id_image"], $_POST["id_author"];
                $this->_likeManager->addLike($_POST["id_image"], $_POST["id_author"]);
            }
            else if ($_POST["submit"] === "unlike")
            {
                $this->_likeManager = new LikeManager;
                $this->_likeManager->disLike($_POST["id_image"], $_POST["id_author"]);
            }
            else {
                if (!$_GET["nb"])
                    $page = 0;
                else
                    $page = $_GET["nb"];
                if ($_GET['submit'] === 'logout')
                    $this->logout();
                else if ($_GET['submit'] === 'malus')
                    $page -= 1;
                else if ($_GET['submit'] === 'plus')
                    $page += 1;
                $this->images($page);
            }
        }
    }


    private function images($page)
    {
        $this->_imageManager = new ImageManager;
        $this->_likeManager = new LikeManager;
        $this->_commentManager = new CommentManager;

        $likes = $this->_likeManager->getAllLikes();
        $comments = $this->_commentManager->getAllComments();
        $images = $this->_imageManager->getAllImages();
        $nb_images = $this->_imageManager->getNbImages();
        $this->_view = new View('Accueil');
        $this->_view->generate(array(
            'images' => $images,
            'page' => $page,
            'nb_images' => $nb_images,
            'likes' => $likes,
            'comments' => $comments,
        ));
    }

    private function logout()
    {
        session_start();
        $_SESSION['login'] = null;
        $_SESSION['id'] = null;
    }
}