<?php

class Comment
{
    private $_id_comments;
    private $_date_comment;
	private $_content;
	private $_id_picture;
	
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    // SET FUNCTIONS
    public function setId_comments($id_comments)
    {
        $this->_id_comments = $id_comments;
    }
	public function setDate_comment($date_comment)
    {
        $this->_date_comment = $date_comment;
    }
    public function setContent($content)
    {
        $this->_content = $content;
	}
	public function setId_picture($id_picture)
    {
        $this->_id_picture = $id_picture;
    }
	
	// GET FUNCTIONS
    public function getId_comments()
    {
        return $this->_id_comments;
    }
	public function getDate_comment()
    {
        return $this->_date_comment;
    }
    public function getContent()
    {
        return $this->_content;
	}
	public function getId_picture()
    {
        return $this->_id_picture;
    }
}