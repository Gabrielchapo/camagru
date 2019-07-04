<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/views/View.php';

class ControllerAccueil
{
    private $_imageManager;
    private $_likeManager;
    private $_commentManager;
    private $_memberManager;
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
                else if ($_GET["submit"] === "comment")
                    $this->comment();
                $this->images($page);
            }
        }
    }
    private function comment()
    {
        $this->_commentManager = new CommentManager;
        $this->_imageManager = new ImageManager;
        $this->_memberManager = new MemberManager;

        //get date
        date_default_timezone_set('Europe/Paris');
        $date_creation = date("Y-m-d H:i:s");
        $date_creation = str_replace(' ', ':', $date_creation);

        //get auhor information and send notification
        $id_author = $this->_imageManager->getIdAuthor($_GET["id_picture"]);
        $member = $this->_memberManager->getMemberById($id_author);
        if ($member["preference"] == 0)
            $this->sendNotificatioEmail($member['email'], $_POST["comment"]);

        //add the comment
        $this->_commentManager->addComment($date_creation, htmlentities($_POST["comment"]), $_GET["id_picture"]);
    }

    private function sendNotificatioEmail($email, $comment)
	{
		$to  = $email;

		$subject = 'Confirmation mail';

		$message = '
					<html>
						<head>
							<title>Confirm your account</title>
						</head>
						<body>
							<a>'.$comment.'</a>
						</body>
					</html>';

		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';

		mail($to, $subject, $message, implode("\r\n", $headers));
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